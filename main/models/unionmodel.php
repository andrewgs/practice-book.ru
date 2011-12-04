<?php

class Unionmodel extends CI_Model{
	
	function __construct(){
        
		parent::__construct();
    }
	
	function contact_manager($activity){
		
		$query = "SELECT tbl_user.uid,tbl_user.uemail,tbl_user.uname,tbl_user.usubname,tbl_user.uthname,tbl_user.uicq,tbl_user.uphone,tbl_user.uactive,tbl_user.uskype,tbl_regions.reg_name,tbl_regions.reg_area,tbl_activity.act_fulltitle,tbl_regions.reg_id,tbl_activity.act_id FROM tbl_user inner join tbl_regions on tbl_user.uregion=tbl_regions.reg_id inner join tbl_activity on tbl_user.uactivity=tbl_activity.act_id where tbl_user.uactivity = $activity and tbl_user.umanager = 1 and tbl_user.ustatus='enabled' ORDER BY tbl_user.upriority";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}
	
	function company_activity($cmp_id,$close){
		
		$query = "SELECT tbl_activity.act_id,tbl_activity.act_fulltitle,tbl_activity.act_title,tbl_companyservices.cs_close from tbl_companyservices inner join tbl_activity on tbl_companyservices.cs_srvid = tbl_activity.act_id inner join tbl_company on tbl_companyservices.cs_cmpid = tbl_company.cmp_id where tbl_company.cmp_id = $cmp_id and tbl_activity.act_final = 1 and (tbl_companyservices.cs_close = 0 OR tbl_companyservices.cs_close = $close) ORDER BY tbl_activity.act_title,tbl_activity.act_fulltitle";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}
	
	function company_ones_activity($id){
		
		$query = "SELECT tbl_activity.act_id,tbl_activity.act_fulltitle,tbl_activity.act_title,tbl_companyservices.cs_close from tbl_companyservices inner join tbl_activity ON tbl_companyservices.cs_srvid = tbl_activity.act_id WHERE tbl_companyservices.cs_id = $id LIMIT 1";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function select_company_by_region($activity,$region){
		
		$query = "SELECT cmp_id,cmp_name,cmp_description,cmp_rating FROM tbl_company INNER JOIN tbl_companyservices ON tbl_company.cmp_id = tbl_companyservices.cs_cmpid WHERE tbl_companyservices.cs_srvid = ? AND tbl_company.cmp_destroy = '3000-01-01' AND tbl_company.cmp_region = ? ORDER BY tbl_company.cmp_rating DESC";
		$query = $this->db->query($query,array($activity,$region));
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}
	
	function select_company_by_rating($activity,$region,$condition,$rating,$days){
		
		$query = "SELECT cmp_id,cmp_name,cmp_description,cmp_rating FROM tbl_company inner join tbl_companyservices on tbl_company.cmp_id = tbl_companyservices.cs_cmpid WHERE tbl_companyservices.cs_srvid = $activity AND tbl_company.cmp_region = $region AND tbl_company.cmp_rating $condition $rating AND tbl_company.cmp_destroy = '3000-01-01' AND DATE_ADD(tbl_company.cmp_date,INTERVAL $days DAY) <= CURDATE() ORDER BY tbl_company.cmp_rating DESC";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}
	
	function mra_region($uid){
		
		$query = "SELECT tbl_regions.reg_id, tbl_regions.reg_name, tbl_regions.reg_area from tbl_mra inner join tbl_regions on tbl_mra.mra_rid = tbl_regions.reg_id  WHERE tbl_mra.mra_uid = ? GROUP BY tbl_regions.reg_id ORDER BY tbl_regions.reg_name";
		$query = $this->db->query($query,array($uid));
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}
	
	function mra_activity_region($uid,$activity,$region){
	
		$query = "SELECT CONCAT(tbl_activity.act_title,', ',tbl_regions.reg_name,' (',tbl_regions.reg_area,')') AS path FROM tbl_mra INNER JOIN tbl_regions on tbl_mra.mra_rid = tbl_regions.reg_id INNER JOIN tbl_activity on tbl_mra.mra_aid = tbl_activity.act_id WHERE tbl_mra.mra_uid = ? AND tbl_mra.mra_rid = ? AND tbl_mra.mra_aid = ?";
		$query = $this->db->query($query,array($uid,$region,$activity));
		$data = $query->result_array();
		if(isset($data[0])) return $data[0]['path'];
		else return "Не известно";
	}

	function update_product($activity,$updata){
	
		$query = "UPDATE tbl_products SET pr_title = ?, pr_note = ?, pr_image = ?, pr_date = ? WHERE pr_mraid IN (SELECT mra_id FROM tbl_mra WHERE mra_aid = ?)";
		$this->db->query($query,array(htmlspecialchars($updata['title']),$updata['note'],$updata['image'],date("Y-m-d"),$activity));
	}

	function read_cmpnews_by_activity($activity,$region){
		
		$query = "SELECT tbl_company.cmp_id,tbl_company.cmp_name,tbl_company.cmp_rating,tbl_cmpnews.cn_id,tbl_cmpnews.cn_title,tbl_cmpnews.cn_note,tbl_cmpnews.cn_pdatebegin FROM tbl_cmpnews inner join tbl_company on tbl_company.cmp_id = tbl_cmpnews.cn_cmpid WHERE tbl_cmpnews.cn_activity = $activity AND tbl_company.cmp_region = $region AND tbl_company.cmp_destroy = '3000-01-01' AND tbl_cmpnews.cn_pdatebegin <= CURDATE() ORDER BY tbl_company.cmp_rating DESC,tbl_company.cmp_id ASC";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}
	
	function read_cmpshares_by_activity($activity,$region){
		
		$query = "SELECT tbl_company.cmp_id,tbl_company.cmp_name,tbl_company.cmp_rating,tbl_cmpshares.sh_id,tbl_cmpshares.sh_title,tbl_cmpshares.sh_note,tbl_cmpshares.sh_pdatebegin FROM tbl_cmpshares inner join tbl_company on tbl_company.cmp_id = tbl_cmpshares.sh_cmpid WHERE tbl_cmpshares.sh_activity = $activity AND tbl_company.cmp_region = $region AND tbl_company.cmp_destroy = '3000-01-01' AND tbl_cmpshares.sh_pdatebegin <= CURDATE() ORDER BY tbl_company.cmp_rating DESC,tbl_company.cmp_id ASC";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}

	function read_pitfalls_limit($activity,$limit){
	
		$query = "SELECT * FROM tbl_pitfalls WHERE tbl_pitfalls.pf_status = 1 AND tbl_pitfalls.pf_mraid IN (SELECT mra_id FROM tbl_mra WHERE tbl_mra.mra_aid = $activity) ORDER BY tbl_pitfalls.pf_date,tbl_pitfalls.pf_id LIMIT $limit";
		
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_activity_news($activity,$limit){
	
		$query = "SELECT * FROM tbl_activity_news WHERE tbl_activity_news.an_mraid IN (SELECT mra_id FROM tbl_mra WHERE tbl_mra.mra_aid = $activity) ORDER BY tbl_activity_news.an_date,tbl_activity_news.an_id LIMIT $limit";
		
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_tips_limit($activity,$limit){
	
		$query = "SELECT * FROM tbl_tips WHERE tbl_tips.tps_status = 1 AND tbl_tips.tps_mraid IN (SELECT mra_id FROM tbl_mra WHERE tbl_mra.mra_aid = $activity) ORDER BY tbl_tips.tps_date,tbl_tips.tps_id LIMIT $limit";
		
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_questions($activity){
	
		$query = "SELECT * FROM tbl_mraquestions WHERE tbl_mraquestions.mraq_status = 1 AND tbl_mraquestions.mraq_priority = 1 AND tbl_mraquestions.mraq_mraid IN (SELECT mra_id FROM tbl_mra WHERE tbl_mra.mra_aid = $activity) ORDER BY tbl_mraquestions.mraq_date DESC,tbl_mraquestions.mraq_id DESC";
		
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function read_documents($activity){
	
		$query = "SELECT * FROM tbl_documents WHERE tbl_documents.doc_mraid IN (SELECT mra_id FROM tbl_mra WHERE tbl_mra.mra_aid = $activity)";
		
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function read_product_group($activity,$mraid){
		
		$query = "SELECT prg_id,prg_title FROM tbl_productgroup INNER JOIN tbl_productionunit WHERE prg_id = pri_groupcode AND prg_activity = $activity AND pri_mraid = $mraid GROUP BY prg_id";
		
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_activity_group(){
		
		$query = "SELECT prg_id,prg_title,act_title FROM tbl_productgroup INNER JOIN tbl_activity WHERE prg_activity = act_id ORDER BY prg_activity,prg_title";
		
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function exist_product_group($group){
		
		$query = "SELECT COUNT(pri_id)+COUNT(cu_id) AS CNT FROM tbl_productgroup LEFT JOIN tbl_productionunit ON prg_id = pri_groupcode LEFT JOIN tbl_companyunits ON prg_id = cu_groupcode WHERE prg_id = $group";
		
		$query = $this->db->query($query);
		$data = $query->result_array();
		if($data[0]['CNT']>0) return TRUE;
		return FALSE;
	}
	
	function read_cmpproduct_group($cmpid){
		
		$query = "SELECT prg_id,prg_title FROM tbl_productgroup INNER JOIN tbl_companyunits WHERE prg_id = cu_groupcode AND cu_cmpid = $cmpid AND prg_activity IN (SELECT cs_srvid FROM tbl_companyservices WHERE cs_cmpid = $cmpid) GROUP BY prg_id";
		
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function offer_list($product,$bprice,$eprice,$region){
	
		$query = "SELECT tbl_company.cmp_id,tbl_company.cmp_name,tbl_companyunits.cu_id,tbl_companyunits.cu_note,tbl_companyunits.cu_price,tbl_companyunits.cu_priceunit,tbl_companyunits.cu_unitscode FROM tbl_company INNER JOIN tbl_companyunits ON tbl_company.cmp_id = tbl_companyunits.cu_cmpid WHERE tbl_companyunits.cu_title = '$product' AND tbl_company.cmp_region = $region AND (tbl_companyunits.cu_price $bprice AND tbl_companyunits.cu_price $eprice) ORDER BY tbl_companyunits.cu_price ASC";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}
	
	function offer_list_top($product,$bprice,$region){
	
		$query = "SELECT tbl_company.cmp_id,tbl_company.cmp_name,tbl_companyunits.cu_id,tbl_companyunits.cu_note,tbl_companyunits.cu_price,tbl_companyunits.cu_priceunit,tbl_companyunits.cu_unitscode FROM tbl_company INNER JOIN tbl_companyunits ON tbl_company.cmp_id = tbl_companyunits.cu_cmpid WHERE tbl_companyunits.cu_title = '$product' AND tbl_company.cmp_region = $region AND tbl_companyunits.cu_price $bprice ORDER BY tbl_companyunits.cu_price ASC";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}

	function users_consultation($type){
	
		switch ($type):
			//федеральные менеджеры
			case '1' : 	$sql = "SELECT tbl_user.uid,tbl_user.uname,tbl_user.usubname,tbl_user.uthname,tbl_user.uemail,tbl_user.ustatus,tbl_user.uactive,tbl_user.usignupdate,tbl_user.udestroy,tbl_user.umanager,tbl_user.upriority,tbl_user.ucompany,tbl_user.uactivity, COUNT(tbl_consultation.cnsl_id) AS consult FROM tbl_user INNER JOIN tbl_consultation ON tbl_consultation.cnsl_uid = tbl_user.uid WHERE tbl_user.umanager=1 AND upriority=1 AND tbl_user.ucompany=0";
						break;
			//региональные менеджеры
			case '2' :	$sql = "SELECT tbl_user.uid,tbl_user.uname,tbl_user.usubname,tbl_user.uthname,tbl_user.uemail,tbl_user.ustatus,tbl_user.uactive,tbl_user.usignupdate,tbl_user.udestroy,tbl_user.umanager,tbl_user.upriority,tbl_user.ucompany,tbl_user.uactivity, COUNT(tbl_consultation.cnsl_id) AS consult FROM tbl_user INNER JOIN tbl_consultation ON tbl_consultation.cnsl_uid = tbl_user.uid WHERE tbl_user.umanager=1 AND upriority=0 AND tbl_user.ucompany=0";
						break;
		endswitch;
		$query = $this->db->query($sql);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function search_unit($search,$region){
		$query = "SELECT tbl_mra.mra_aid AS id,tbl_productionunit.pri_id AS pid,tbl_productionunit.pri_title AS title FROM tbl_productionunit INNER JOIN tbl_mra ON tbl_productionunit.pri_mraid = tbl_mra.mra_id WHERE tbl_productionunit.pri_title LIKE '%$search%' AND tbl_mra.mra_rid = $region ORDER BY tbl_productionunit.pri_title";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function units_by_activity($activity){
		$param = '';
		$cnt = count($activity);
		for($i=0;$i<$cnt;$i++):
			$param .= $activity[$i];
			if($cnt>1 && $i<$cnt-1) $param .= ',';
		endfor;
		$query = "SELECT pri_title AS title, pri_note AS note, pri_unitscode AS unitscode, pri_image AS image, pri_groupcode AS groupe FROM tbl_productionunit INNER JOIN tbl_productgroup ON pri_groupcode = prg_id WHERE prg_activity IN ($param)";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}

	function dsc_topics_limit_records($count,$from,$dsc){
		
		$query = "SELECT top_id,top_title,top_note,top_date,top_usrid,top_comments,uname,usubname,uthname,uposition,cmp_id,cmp_name FROM tbl_dsc_topics,tbl_user,tbl_company WHERE tbl_dsc_topics.top_usrid = tbl_user.uid AND tbl_user.ucompany = tbl_company.cmp_id AND tbl_dsc_topics.top_dscid = $dsc ORDER BY top_date DESC, top_id DESC LIMIT $from,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}

	function dsc_topic_records($topic){
		
		$query = "SELECT top_id,top_title,top_note,top_date,top_usrid,top_comments,uemail,uname,usubname,uthname,uposition,uconfirmation,cmp_id,cmp_name FROM tbl_dsc_topics,tbl_user,tbl_company WHERE tbl_dsc_topics.top_usrid = tbl_user.uid AND tbl_user.ucompany = tbl_company.cmp_id AND tbl_dsc_topics.top_id = $topic";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data[0];
		else return null;
	}

	function topic_comments_limit_records($count,$from,$topic,$group){
	
		$query = "SELECT cmn_id,cmn_note,cmn_date,cmn_usrid,uname,usubname,uthname,uposition,cmp_id,cmp_name FROM tbl_comments,tbl_user,tbl_company WHERE tbl_comments.cmn_usrid = tbl_user.uid AND tbl_user.ucompany = tbl_company.cmp_id AND tbl_comments.cmn_topid = $topic AND tbl_comments.cmn_group = $group ORDER BY cmn_date DESC, cmn_id DESC LIMIT $from,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}

	function qa_topics_limit_records($count,$from,$qa){
		
		$query = "SELECT qat_id,qat_title,qat_date,qat_usrid,qat_comments,uname,usubname,uthname,uposition,cmp_id,cmp_name FROM tbl_qa_topics,tbl_user,tbl_company WHERE tbl_qa_topics.qat_usrid = tbl_user.uid AND tbl_user.ucompany = tbl_company.cmp_id AND tbl_qa_topics.qat_qaid = $qa ORDER BY qat_date DESC, qat_id DESC LIMIT $from,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}

	function qa_topic_records($topic){
		
		$query = "SELECT qat_id,qat_title,qat_date,qat_usrid,qat_comments,uemail,uconfirmation,uname,usubname,uthname,uposition,cmp_id,cmp_name FROM tbl_qa_topics,tbl_user,tbl_company WHERE tbl_qa_topics.qat_usrid = tbl_user.uid AND tbl_user.ucompany = tbl_company.cmp_id AND tbl_qa_topics.qat_id = $topic";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data[0];
		else return null;
	}
	
	function articles_limit_records($count,$from,$section,$field){
		
		$query = "SELECT atp_id,atp_title,atp_note,atp_date,atp_usrid,atp_comments,atp_views,uname,usubname,uthname,uposition,cmp_id,cmp_name FROM tbl_art_topics,tbl_user,tbl_company WHERE tbl_art_topics.atp_usrid = tbl_user.uid AND tbl_user.ucompany = tbl_company.cmp_id AND tbl_art_topics.atp_artid = $section ORDER BY $field DESC, atp_id DESC LIMIT $from,$count";
//		die($query);
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}
	
	function article_topic_records($article){
		
		$query = "SELECT atp_id,atp_title,atp_note,atp_date,atp_usrid,atp_comments,atp_views,uemail,uconfirmation,uname,usubname,uthname,uposition,cmp_id,cmp_name FROM tbl_art_topics,tbl_user,tbl_company WHERE tbl_art_topics.atp_usrid = tbl_user.uid AND tbl_user.ucompany = tbl_company.cmp_id AND tbl_art_topics.atp_id = $article";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data[0];
		else return null;
	}

	function int_topics_limit_records($count,$from,$int){
		
		$query = "SELECT itp_id,itp_title,itp_note,itp_date,itp_usrid,itp_comments,uname,usubname,uthname,uposition,cmp_id,cmp_name FROM tbl_inttopics,tbl_user,tbl_company WHERE tbl_inttopics.itp_usrid = tbl_user.uid AND tbl_user.ucompany = tbl_company.cmp_id AND tbl_inttopics.itp_intid = $int ORDER BY itp_date DESC, itp_id DESC LIMIT $from,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}

	function int_topic_records($topic){
		
		$query = "SELECT itp_id,itp_title,itp_note,itp_date,itp_usrid,itp_comments,uemail,uconfirmation,uname,usubname,uthname,uposition,cmp_id,cmp_name FROM tbl_inttopics,tbl_user,tbl_company WHERE tbl_inttopics.itp_usrid = tbl_user.uid AND tbl_user.ucompany = tbl_company.cmp_id AND tbl_inttopics.itp_id = $topic";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data[0];
		else return null;
	}
	
	function dtn_topics_limit_records($count,$from,$dtn){
		
		$query = "SELECT dtt_id,dtt_note,dtt_date,dtt_usrid,dtt_comments,dtt_documents,uname,usubname,uthname,uposition,cmp_id,cmp_name FROM tbl_dtn_topics,tbl_user,tbl_company WHERE tbl_dtn_topics.dtt_usrid = tbl_user.uid AND tbl_user.ucompany = tbl_company.cmp_id AND tbl_dtn_topics.dtt_dtnid = $dtn ORDER BY dtt_date DESC, dtt_id DESC LIMIT $from,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}

	function dtn_topic_records($topic){
		
		$query = "SELECT dtt_id,dtt_note,dtt_date,dtt_usrid,dtt_comments,dtt_documents,uemail,uconfirmation,uname,usubname,uthname,uposition,cmp_id,cmp_name FROM tbl_dtn_topics,tbl_user,tbl_company WHERE tbl_dtn_topics.dtt_usrid = tbl_user.uid AND tbl_user.ucompany = tbl_company.cmp_id AND tbl_dtn_topics.dtt_id = $topic";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data[0];
		else return null;
	}

	function documents_limit_records($count,$from,$topic){

		$query = "SELECT dls_id,dls_title,dls_note,dls_date,dls_link,dls_usrid,dls_comments,uname,usubname,uthname,uposition,cmp_id,cmp_name FROM tbl_doclist,tbl_user,tbl_company WHERE tbl_doclist.dls_usrid = tbl_user.uid AND tbl_user.ucompany = tbl_company.cmp_id AND tbl_doclist.dls_dtnid = $topic ORDER BY dls_date DESC, dls_id DESC LIMIT $from,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}

	function dls_document_record($id){

		$query = "SELECT dls_id,dls_title,dls_note,dls_date,dls_link,dls_usrid,dls_comments,uemail,uconfirmation,uname,usubname,uthname,uposition,cmp_id,cmp_name FROM tbl_doclist,tbl_user,tbl_company WHERE tbl_doclist.dls_usrid = tbl_user.uid AND tbl_user.ucompany = tbl_company.cmp_id AND tbl_doclist.dls_id = $id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data[0];
		else return null;
	}

	function sur_topics_limit_records($count,$from,$sur){
		
		$query = "SELECT stp_id,stp_title,stp_clicks,stp_date,stp_usrid,stp_comments,uname,usubname,uthname,uposition,cmp_id,cmp_name FROM tbl_surtopics,tbl_user,tbl_company WHERE tbl_surtopics.stp_usrid = tbl_user.uid AND tbl_user.ucompany = tbl_company.cmp_id AND tbl_surtopics.stp_surid = $sur ORDER BY stp_date DESC, stp_id DESC LIMIT $from,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}

	function sur_topic_records($topic){
		
		$query = "SELECT stp_id,stp_title,stp_clicks,stp_date,stp_usrid,stp_comments,uemail,uconfirmation,uname,usubname,uthname,uposition,cmp_id,cmp_name FROM tbl_surtopics,tbl_user,tbl_company WHERE tbl_surtopics.stp_usrid = tbl_user.uid AND tbl_user.ucompany = tbl_company.cmp_id AND tbl_surtopics.stp_id = $topic";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data[0];
		else return null;
	}

	function asp_topics_limit_records($count,$from,$asp,$region,$company){
		
		$query = "SELECT ast_id,ast_title,ast_note,ast_date,ast_usrid,ast_comments,ast_price,ast_collected,ast_must1,ast_must2,ast_must3,ast_apply,ast_company,uname,usubname,uthname,uposition,cmp_id,cmp_name FROM tbl_asptopics,tbl_user,tbl_company,tbl_aspregions WHERE tbl_asptopics.ast_usrid = tbl_user.uid AND tbl_user.ucompany = tbl_company.cmp_id AND tbl_aspregions.asr_astid = tbl_asptopics.ast_id AND tbl_asptopics.ast_aspid = $asp AND (tbl_aspregions.asr_regid = $region OR tbl_asptopics.ast_company = $company) GROUP BY tbl_aspregions.asr_astid ORDER BY ast_date DESC, ast_id DESC LIMIT $from,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}

	function asp_topic_records($topic){
		
		$query = "SELECT ast_id,ast_title,ast_note,ast_date,ast_usrid,ast_comments,ast_price,ast_collected,ast_must1,ast_must2,ast_must3,ast_company,ast_apply,uemail,uconfirmation,uname,usubname,uthname,uposition,cmp_id,cmp_name FROM tbl_asptopics,tbl_user,tbl_company WHERE tbl_asptopics.ast_usrid = tbl_user.uid AND tbl_user.ucompany = tbl_company.cmp_id AND tbl_asptopics.ast_id = $topic";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data[0];
		else return null;
	}

	function oft_topics_limit_records($count,$from,$environment,$department,$activity,$field,$region,$company){
		
		if(!$environment) $department = 0;
		$query = "SELECT oft_id,oft_title,oft_date,oft_note,oft_userid,oft_comments,oft_cmpid,oft_cmpname,uname,usubname,uthname,uposition FROM tbl_offertopic,tbl_user WHERE tbl_offertopic.oft_userid = tbl_user.uid AND tbl_offertopic.oft_environment = $environment AND tbl_offertopic.oft_department = $department AND (tbl_offertopic.oft_activity = $activity OR oft_cmpid = $company) AND oft_region = $region ORDER BY $field LIMIT $from,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}

	function oft_topic_record($topic,$environment,$department,$region){
		
		if(!$environment) $department = 0;
		$query = "SELECT oft_id,oft_title,oft_date,oft_note,oft_userid,oft_comments,oft_cmpid,oft_cmpname,uemail,uconfirmation,uname,usubname,uthname,uposition FROM tbl_offertopic,tbl_user WHERE tbl_offertopic.oft_userid = tbl_user.uid AND tbl_offertopic.oft_id = $topic AND tbl_offertopic.oft_environment = $environment AND tbl_offertopic.oft_department = $department AND oft_region = $region";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data[0];
		else return null;
	}

	function ben_topics_limit_records($count,$from,$environment,$department,$activity,$group,$field){
		
		if(!$environment) $department = 0;
		$query = "SELECT ben_id,ben_title,ben_note,ben_date,ben_source,ben_userid,ben_comments,ben_views,uname,usubname,uthname,uposition,cmp_id,cmp_name FROM tbl_be_news,tbl_user,tbl_company WHERE tbl_be_news.ben_userid IN(0,tbl_user.uid) AND tbl_user.ucompany = tbl_company.cmp_id AND tbl_be_news.ben_environment = $environment AND tbl_be_news.ben_department = $department AND tbl_be_news.ben_activity = $activity AND tbl_be_news.ben_group = $group GROUP BY tbl_be_news.ben_id ORDER BY $field DESC, ben_id DESC LIMIT $from,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}

	function ben_topic_record($topic,$environment,$department,$activity,$group){
		
		if(!$environment) $department = 0;
		$query = "SELECT ben_id,ben_title,ben_note,ben_date,ben_source,ben_userid,ben_comments,ben_views,uemail,uconfirmation,uname,usubname,uthname,uposition,cmp_id,cmp_name FROM tbl_be_news,tbl_user,tbl_company WHERE tbl_be_news.ben_userid IN(0,tbl_user.uid) AND tbl_user.ucompany = tbl_company.cmp_id AND tbl_be_news.ben_environment = $environment AND tbl_be_news.ben_department = $department AND tbl_be_news.ben_activity = $activity AND tbl_be_news.ben_group = $group AND tbl_be_news.ben_id = $topic";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data[0];
		else return null;
	}
																				  
	function bed_topics_limit_records($count,$from,$environment,$department,$activity,$group,$field){
		
		if(!$environment) $department = 0;
		$query = "SELECT bed_id,bed_title,bed_note,bed_date,bed_userid,bed_comments,bed_views,uname,usubname,uthname,uposition,cmp_id,cmp_name FROM tbl_be_discount,tbl_user,tbl_company WHERE tbl_be_discount.bed_userid IN(0,tbl_user.uid) AND tbl_user.ucompany = tbl_company.cmp_id AND tbl_be_discount.bed_environment = $environment AND tbl_be_discount.bed_department = $department AND tbl_be_discount.bed_activity = $activity AND tbl_be_discount.bed_group = $group GROUP BY tbl_be_discount.bed_id ORDER BY $field DESC, bed_id DESC LIMIT $from,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}

	function bed_topic_record($topic,$environment,$department,$activity,$group){
		
		if(!$environment) $department = 0;
		$query = "SELECT bed_id,bed_title,bed_note,bed_date,bed_userid,bed_comments,bed_views,uemail,uconfirmation,uname,usubname,uthname,uposition,cmp_id,cmp_name FROM tbl_be_discount,tbl_user,tbl_company WHERE tbl_be_discount.bed_userid IN(0,tbl_user.uid) AND tbl_user.ucompany = tbl_company.cmp_id AND tbl_be_discount.bed_environment = $environment AND tbl_be_discount.bed_department = $department AND tbl_be_discount.bed_activity = $activity AND tbl_be_discount.bed_group = $group AND tbl_be_discount.bed_id = $topic";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data[0];
		else return null;
	}

	function rating_repsentatives($count,$from,$activity,$field){
		
		$query = "SELECT uid,ucompany,uemail,uname,usubname,uthname,uicq,uphone,ustatus,usignupdate,ulastlogindate,PERIOD_DIFF(date_format(now(),'%Y%m'), date_format(usignupdate,'%Y%m')) AS months,uskype,uposition,uachievement,urating,cmp_id,cmp_name FROM tbl_user,tbl_company,tbl_companyservices WHERE tbl_user.ucompany = tbl_company.cmp_id AND tbl_company.cmp_id = tbl_companyservices.cs_cmpid AND tbl_companyservices.cs_srvid = $activity GROUP BY tbl_user.uid ORDER BY $field DESC LIMIT $from,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}
	
	function rating_search_repsentatives($schvalue,$activity){
		
		$query = "SELECT uid,ucompany,uemail,uname,usubname,uthname,uicq,uphone,ustatus,usignupdate,ulastlogindate,PERIOD_DIFF(date_format(now(),'%Y%m'), date_format(usignupdate,'%Y%m')) AS months,uskype,uposition,uachievement,urating,cmp_id,cmp_name FROM tbl_user,tbl_company,tbl_companyservices WHERE tbl_user.ucompany = tbl_company.cmp_id AND tbl_company.cmp_id = tbl_companyservices.cs_cmpid AND tbl_companyservices.cs_srvid = $activity AND (uname LIKE '%$schvalue%' OR usubname LIKE '%$schvalue%' OR uthname LIKE '%$schvalue%') GROUP BY tbl_user.uid LIMIT 10";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}
	
	function count_repsentatives($activity){
		
		$query = "SELECT uid AS cnt FROM tbl_user,tbl_company,tbl_companyservices WHERE tbl_user.ucompany = tbl_company.cmp_id AND tbl_company.cmp_id = tbl_companyservices.cs_cmpid AND tbl_companyservices.cs_srvid = $activity GROUP BY tbl_user.uid";
		$query = $this->db->query($query);
		$data = $query->result_array();
		return count($data);
	}
	
	function count_company($activity){
		
		$query = "SELECT cmp_id FROM tbl_company,tbl_companyservices WHERE tbl_company.cmp_id = tbl_companyservices.cs_cmpid AND tbl_companyservices.cs_srvid = $activity GROUP BY cmp_id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		return count($data);
	}
	
	function rating_company($count,$from,$activity,$field){
		
		$query = "SELECT cmp_id,cmp_name,cmp_description,cmp_site,cmp_email,cmp_phone,cmp_uraddress,cmp_realaddress,cmp_rating,PERIOD_DIFF(date_format(now(),'%Y%m'), date_format(cmp_date,'%Y%m')) AS months FROM tbl_company,tbl_companyservices WHERE tbl_company.cmp_id = tbl_companyservices.cs_cmpid AND tbl_companyservices.cs_srvid = $activity GROUP BY cmp_id ORDER BY $field DESC LIMIT $from,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}
	
	function rating_search_company($schvalue,$activity){
		
		$query = "SELECT cmp_id,cmp_name,cmp_description,cmp_site,cmp_email,cmp_phone,cmp_uraddress,cmp_realaddress,cmp_rating,PERIOD_DIFF(date_format(now(),'%Y%m'), date_format(cmp_date,'%Y%m')) AS months FROM tbl_company,tbl_companyservices WHERE tbl_company.cmp_id = tbl_companyservices.cs_cmpid AND tbl_companyservices.cs_srvid = $activity AND cmp_name LIKE '%$schvalue%' GROUP BY cmp_id LIMIT 10";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}

	function wmncompany_limit_records($count,$from,$wmnid){
		
		$query = "SELECT wmc_id,wmc_wmnid,wmc_date,wmc_userid,wmc_price,cmp_id,cmp_name,cmp_uraddress,cmp_realaddress,cmp_rating,cmp_phone,cmp_email,cmp_site,PERIOD_DIFF(date_format(now(),'%Y%m'), date_format(cmp_date,'%Y%m')) AS months FROM tbl_wmcompany,tbl_company WHERE tbl_wmcompany.wmc_cmpid = tbl_company.cmp_id AND wmc_wmnid = $wmnid ORDER BY tbl_wmcompany.wmc_price DESC, tbl_wmcompany.wmc_id ASC LIMIT $from,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}

	function read_auctions($activity){
	
		$query = "SELECT wmn_id,wmn_edate,wmn_cmpid,wmn_cmpname,wmn_price,reg_name FROM tbl_whomain,tbl_regions WHERE tbl_whomain.wmn_region = tbl_regions.reg_id AND tbl_whomain.wmn_activity = $activity ORDER BY tbl_regions.reg_name";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function winner_auction($wmnid){
	
		$query = "SELECT wmc_id,wmc_price,cmp_id,cmp_name FROM tbl_wmcompany,tbl_company WHERE tbl_wmcompany.wmc_cmpid = tbl_company.cmp_id AND wmc_wmnid = $wmnid ORDER BY tbl_wmcompany.wmc_price DESC, tbl_wmcompany.wmc_id ASC LIMIT 1";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data[0];
		return NULL;
	}

	function dealer_regions($dlrid){
		
		$query = "SELECT reg_id,reg_name,reg_area FROM tbl_regions,tbl_dealer_region WHERE tbl_dealer_region.drg_regid = tbl_regions.reg_id AND drg_dlrid = $dlrid ORDER BY reg_name";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function dealers_region($region){
		
		$query = "SELECT dlr_id,dlr_email,dlr_name,dlr_subname,dlr_thname,dlr_phone,dlr_confirmation,dlr_skype,dlr_icq,dlr_position,dlr_status,dlr_active,dlr_company,PERIOD_DIFF(date_format(now(),'%Y%m'), date_format(dlr_signupdate,'%Y%m')) AS months FROM tbl_dealers,tbl_dealer_region WHERE tbl_dealer_region.drg_dlrid = tbl_dealers.dlr_id AND tbl_dealer_region.drg_regid = $region ORDER BY dlr_subname,dlr_name,dlr_thname";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}

	function delete_pricing($activity){
	
		$query = "DELETE FROM tbl_pricing WHERE prn_mraid IN (SELECT mra_id FROM tbl_mra WHERE mra_aid = $activity)";
		$this->db->query($query);
		return $this->db->affected_rows();
	}

	function delete_season($activity){
	
		$query = "DELETE FROM tbl_seasonal_prices WHERE snp_mraid IN (SELECT mra_id FROM tbl_mra WHERE mra_aid = $activity)";
		$this->db->query($query);
		return $this->db->affected_rows();
	}

	function read_belog($date){
	
		$query = "SELECT belg_id,belg_edit,belg_delete,belg_activity,belg_table,belg_environment,act_title,dep_title FROM tbl_be_log,tbl_activity,tbl_departments WHERE tbl_be_log.belg_department IN (tbl_departments.dep_id,0) AND tbl_be_log.belg_activity = tbl_activity.act_id AND tbl_be_log.belg_date = '$date' group by belg_id ORDER BY belg_id DESC";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_belog_information($id){
	
		$query = "SELECT belg_id,belg_title_field,belg_note_field,belg_table,belg_model,belg_object_id,belg_object_field,uid,uemail,uskype,uicq,uphone,uposition,uname,usubname,uthname,uactive,urating,cmp_id,cmp_name,cmp_rating FROM tbl_be_log,tbl_user,tbl_company WHERE tbl_be_log.belg_userid = tbl_user.uid AND tbl_be_log.belg_cmpid = tbl_company.cmp_id AND tbl_be_log.belg_id = $id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
}
?>