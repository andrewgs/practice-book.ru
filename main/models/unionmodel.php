<?php

class Unionmodel extends CI_Model {
	
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
	
	function company_activity($cmp_id){
		
		$query = "SELECT tbl_activity.act_id,tbl_activity.act_fulltitle from tbl_companyservices inner join tbl_activity on tbl_companyservices.cs_srvid = tbl_activity.act_id inner join tbl_company on tbl_companyservices.cs_cmpid = tbl_company.cmp_id where tbl_company.cmp_id = $cmp_id and tbl_activity.act_final = 1 ";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}
	
	function select_company_by_region($activity,$region){
		
		$query = "SELECT cmp_id,cmp_name,cmp_description,cmp_rating FROM tbl_company INNER JOIN tbl_companyservices ON tbl_company.cmp_id = tbl_companyservices.cs_cmpid WHERE tbl_companyservices.cs_srvid = ? AND tbl_company.cmp_region = ? ORDER BY tbl_company.cmp_rating DESC";
		$query = $this->db->query($query,array($activity,$region));
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}
	
	function select_company_by_rating($activity,$region,$condition,$rating,$days){
		
		$query = "SELECT cmp_id,cmp_name,cmp_description,cmp_rating FROM tbl_company inner join tbl_companyservices on tbl_company.cmp_id = tbl_companyservices.cs_cmpid WHERE tbl_companyservices.cs_srvid = $activity AND tbl_company.cmp_region = $region AND tbl_company.cmp_rating $condition $rating AND DATE_ADD(tbl_company.cmp_date,INTERVAL $days DAY) <= CURDATE() ORDER BY tbl_company.cmp_rating DESC";
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
		
		$query = "SELECT tbl_company.cmp_id,tbl_company.cmp_name,tbl_company.cmp_rating,tbl_cmpnews.cn_id,tbl_cmpnews.cn_title,tbl_cmpnews.cn_note,tbl_cmpnews.cn_pdatebegin FROM tbl_cmpnews inner join tbl_company on tbl_company.cmp_id = tbl_cmpnews.cn_cmpid WHERE tbl_cmpnews.cn_activity = $activity AND tbl_company.cmp_region = $region AND tbl_cmpnews.cn_pdatebegin <= CURDATE() ORDER BY tbl_company.cmp_rating DESC,tbl_company.cmp_id ASC";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}
	
	function read_cmpshares_by_activity($activity,$region){
		
		$query = "SELECT tbl_company.cmp_id,tbl_company.cmp_name,tbl_company.cmp_rating,tbl_cmpshares.sh_id,tbl_cmpshares.sh_title,tbl_cmpshares.sh_note,tbl_cmpshares.sh_pdatebegin FROM tbl_cmpshares inner join tbl_company on tbl_company.cmp_id = tbl_cmpshares.sh_cmpid WHERE tbl_cmpshares.sh_activity = $activity AND tbl_company.cmp_region = $region AND tbl_cmpshares.sh_pdatebegin <= CURDATE() ORDER BY tbl_company.cmp_rating DESC,tbl_company.cmp_id ASC";
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
	
	function read_cmpproduct_group($cmpid){
		
		$query = "SELECT prg_id,prg_title FROM tbl_productgroup INNER JOIN tbl_companyunits WHERE prg_id = cu_groupcode AND cu_cmpid = $cmpid AND prg_activity IN (SELECT cs_srvid FROM tbl_companyservices WHERE cs_cmpid = $cmpid) GROUP BY prg_id";
		
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function offer_list($product,$bprice,$eprice,$region){
	
		$query = "SELECT tbl_company.cmp_id,tbl_company.cmp_name,tbl_companyunits.cu_id,tbl_companyunits.cu_note,tbl_companyunits.cu_price,tbl_companyunits.cu_priceunit,tbl_companyunits.cu_unitscode FROM tbl_company INNER JOIN tbl_companyunits ON tbl_company.cmp_id = tbl_companyunits.cu_cmpid WHERE tbl_companyunits.cu_title = '$product' AND tbl_company.cmp_region = $region AND (CONCAT(tbl_companyunits.cu_price,0) >= $bprice AND CONCAT(tbl_companyunits.cu_price,0) <= $eprice) ORDER BY tbl_companyunits.cu_price ASC";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		else return null;
	}
	
	function offer_list_top($product,$bprice,$region){
	
		$query = "SELECT tbl_company.cmp_id,tbl_company.cmp_name,tbl_companyunits.cu_id,tbl_companyunits.cu_note,tbl_companyunits.cu_price,tbl_companyunits.cu_priceunit,tbl_companyunits.cu_unitscode FROM tbl_company INNER JOIN tbl_companyunits ON tbl_company.cmp_id = tbl_companyunits.cu_cmpid WHERE tbl_companyunits.cu_title = '$product' AND tbl_company.cmp_region = $region AND CONCAT(tbl_companyunits.cu_price,0) >= $bprice ORDER BY tbl_companyunits.cu_price ASC";
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

	function search_unit($search){
		$query = "SELECT tbl_mra.mra_aid AS id,tbl_productionunit.pri_id AS pid,tbl_productionunit.pri_title AS title FROM tbl_productionunit INNER JOIN tbl_mra ON tbl_productionunit.pri_mraid = tbl_mra.mra_id WHERE tbl_productionunit.pri_title LIKE '%$search%' ORDER BY tbl_productionunit.pri_title";
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
}
?>