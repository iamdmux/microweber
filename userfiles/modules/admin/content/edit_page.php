<?

if(!isset($params["data-page-id"])){
	$params["data-page-id"] = PAGE_ID;
}
 

$data = get_content_by_id($params["data-page-id"]); 

if($data == false or empty($data )){
include('_empty_content_data.php');	
}
$form_rand_id = md5(serialize($data));
?>
<script  type="text/javascript">

mw.require('forms.js');
 

$(document).ready(function(){
	
	 
	 
	 $('#admin_edit_page_form_<? print $form_rand_id ?>').submit(function() { 

 
 mw.form.post($('#admin_edit_page_form_<? print $form_rand_id ?>') , '<? print site_url('api/save_content') ?>');
 
 
 return false;
 
 
 });
   
 


 
   
});
</script>

<textarea>
 
 
 <? print_r($data); ?> 
 
 </textarea>
<form id="admin_edit_page_form_<? print $form_rand_id ?>">
  id
  <input name="id"  type="text" value="<? print ($data['id'])?>" />
  <br />
  content_parent
  <? $pages = get_content('content_type=page');   ?>
  <? if(!empty($pages)): ?>
  <select name="content_parent">
    <option value="0"   <? if((0 == intval($data['content_parent']))): ?>   selected="selected"  <? endif; ?>>None</option>
    <? foreach($pages as $item): ?>
    <option value="<? print $item['id'] ?>"   <? if(($item['id'] == $data['content_parent']) and $item['id'] != $data['id']): ?>   selected="selected"  <? endif; ?>  <? if($item['id'] == $data['id']): ?>    disabled="disabled"  <? endif; ?>  >
    <? print $item['content_title'] ?>
    </option>
    <? endforeach; ?>
  </select>
  <? endif; ?>
  <br />
  content_type
  <input name="content_type"  type="text" value="<? print ($data['content_type'])?>" />
  <br />
  content_title
  <input name="content_title"  type="text" value="<? print ($data['content_title'])?>" />
  <br />
  content_url
  <input name="content_url"  type="text" value="<? print ($data['content_url'])?>" />
  <br />
  is_active
  <input name="is_active"  type="text" value="<? print ($data['is_active'])?>" />
  <br />
  content_subtype
  <input name="content_subtype"  type="text" value="<? print ($data['content_subtype'])?>" />
  <br />
  content_description
  <input name="content_description"  type="text" value="<? print ($data['content_description'])?>" />
  <br />
  content_subtype_value
  <input name="content_subtype_value"  type="text" value="<? print ($data['content_subtype_value'])?>" />
  <br />
  <module data-type="admin/content/layout_selector" data-page-id="<? print ($data['id'])?>" />
  <input type="submit" name="save" value="save" />
</form>
