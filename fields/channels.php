<?php

/**
 * @author     Jibon Lawrence Costa
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
defined('JPATH_BASE') or die();

/**
 *
 */
class JFormFieldChannels extends JFormField {

    /**
     * Element name
     *
     * @access	protected
     * @var		string
     */
    var $_name = 'Channels';

    /**
     * @var string
     */
    protected $type = 'Channels';

    /**
     * @return string
     */
    public function getInput() {

        $html = "
		<script type=\"text/javascript\">
                    jQuery(\"document\").ready(function($){
			var i = 1;
			if (parseInt($('#field p:last').attr('id')) > 0){
				i = parseInt($('#field p:last').attr('id')) + 1;
			}
			$('#add').click(function(){
				$('#field').append(\"<p id='\"+i+\"'>Channel Name:<input name='lan'/> URL:<input name='tag'/><span id='delete' action='\"+i+\"' class='btn btn-small icon-cancel'></span></p>\");
				i++;
			});
			$('#save').live('click',function(){
				$('#fieldval').val('');
				$('#field p').each(function(index){
					var id = $(this).attr('id');
					var lan = $(this).children('input:nth(0)').val();
					var tag = $(this).children('input:nth(1)').val();
					$('#fieldval').val($('#fieldval').val()+ id+'|'+lan+'|'+tag+',');
				});
				Joomla.submitbutton('module.apply');
			});
			$('#delete').live('click', function(){
				var id = $(this).attr('action');
				$('#field p[id=\"'+id+'\"]').remove();
				});

			});
		</script>

		<span id='add' class='btn btn-small'>Add</span>
		<div id='field'>


		";
        if (!empty($this->value)) {
            $primary = explode(',', rtrim($this->value, ","));
            foreach ($primary as $value) {
                $extract = explode("|", $value);
                if (!empty($extract[1])) {
                    $input .= "<p id='" . $extract[0] . "'>Channel Name:<input name='lan' value='" . $extract[1] . "'/> URL:<input name='tag' value='" . $extract[2] . "'/><span id='delete' action='" . $extract[0] . "' class='btn btn-small icon-cancel'></span></p>";
                }
            }
            $html .= $input;
        }

        $html .="</div><p></p><span id='save' class='btn btn-small btn-success'>Save</span>";
        $html .= '<textarea style="display: none;" name="' . $this->name . '" id="fieldval">' . $this->value . '</textarea>';
        return $html;
    }

}
