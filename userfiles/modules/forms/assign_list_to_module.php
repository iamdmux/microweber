<? if(is_admin()==false) { mw_error('You must be logged as admin', 1); } ?>
<? if(!isset($params['for-module']) or !isset($params['for-module-id'])): ?>
<?  mw_warn('Error: in module "'.$config['module'].'" - You must set "for-module" and "for-module-id" parameters on this module'); return; ?>
<? endif; ?>
<script  type="text/javascript">
  mw.require("forms.js",true);
</script>
<? //$rand = uniqid(); ?>
<script  type="text/javascript">


isCreating = false;


function mw_create_new_list_{rand}(){
  if(!isCreating){

      isCreating = true;
	  mw.form.post('.mw_create_new_forms_list{rand}', '<? print api_url('save_form_list'); ?>', function(){



        mw.reload_module('<? print $config['module'] ?>', function(){
          isCreating = false;
        });
    }





      );
   }
	  return false;
}


</script>
<? $selected_list = get_option('list_id', $params['for-module-id']);
$data = get_form_lists('order_by=created_on desc&module_name='.$params['for-module']);;
  ?>
<? if(isarr($data )): ?>

<div id="form_dropdown_lists">
  <label class="mw-ui-label">Save form entires to existing list</label>
  <div class="mw-ui-select left" style="width: 250px;">
    <select name="list_id"   class="mw_option_field" option-group="<? print $params['for-module-id'] ?>"  >

<option    value=""  <? if(intval($selected_list) == 0): ?>   selected="selected"  <? endif; ?>>Default list</option>

      <? foreach($data  as $item): ?>
      <option    value="<? print $item['id'] ?>"  <? if((intval($selected_list) == intval($item['id']))): ?>   selected="selected"  <? endif; ?>><? print $item['title'] ?></option>
      <? endforeach ; ?>
    </select>
  </div>
  <div class="left">&nbsp;&nbsp;&nbsp;<strong>or</strong>&nbsp;&nbsp;&nbsp;
    <button class="mw-ui-btn" onclick="mw.$('.mw_create_new_forms_list{rand}, #form_dropdown_lists').toggle()">Create New</button>
  </div>
</div>
<div class="mw_create_new_forms_list{rand}" style="display: none;">
  <div class="vSpace"></div>
  <label class="mw-ui-label">Name of the new list</label>
  <input type="hidden" name="for_module" value="<? print $params['for-module'] ?>"  />
  <input type="hidden" name="for_module_id" value="<? print $params['for-module-id'] ?>"  />
  <input type="text" name="mw_new_forms_list" class="mw-ui-field" id="mw_new_form_list_title" value="" style="width: 200px;margin-right: 10px;"  />
  <button class="mw-ui-btn" onclick="mw_create_new_list_{rand}()">Create</button>
  &nbsp;<span class="mw-ui-delete" onclick="mw.$('.mw_create_new_forms_list{rand}, #form_dropdown_lists').toggle()">Cancel</span> </div>
<div class="vSpace"></div>
<?php else: ?>
<div class="mw_create_new_forms_list{rand}" style="padding-bottom: 12px;">
  <label class="mw-ui-label">Name of the new list</label>
  <input type="hidden" name="for_module" value="<? print $params['for-module'] ?>"  />
  <input type="hidden" name="for_module_id" value="<? print $params['for-module-id'] ?>"  />
  <input type="text" name="mw_new_forms_list" value="" class="mw-ui-field" style="width: 200px;margin-right: 10px;"  />
  <button class="mw-ui-btn" onclick="mw_create_new_list_{rand}()">Create</button>
</div>
<? endif; ?>
