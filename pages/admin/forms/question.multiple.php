<div id="sub_form_multiple" class="sub_form">
	<h3>Multiple Choice Answers</h3>
	
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<thead>
			<tr>
				<td>Name</td>
				<td>Correct</td>
				<td>Selected By Default</td>
				<td>Delete</td>
                <td>Category</td>
                <td>Image</td>
			</tr>
		</thead>
		<tbody>
			<?php   $i = 0;
					foreach( $answers as $key => $answer ) {
                        $name = $answer["text"];

                        ?>
				<tr>
					<td><input type="text" name="multiple_name[<?php echo $i; ?>]" value="<?php echo esc_attr(wp_kses_stripslashes($name)); ?>" /></td>
					<td><input type="checkbox" name="multiple_correct[<?php echo  $i; ?>]" <?php if ( $answer["correct"] == "yes" ){ ?> checked="checked"<?php }?> value="yes" /></td>
					<td><input type="radio" name="multiple_default" <?php if ( isset($answer["default"]) && $answer["default"] == "yes" ){ ?> checked="checked"<?php }?> value="<?php echo $i; ?>" /></td>
					<td><input type="checkbox" name="multiple_delete[<?php echo  $i; ?>]" value="yes" /></td>
                    <td><input type="text" name="multiple_category[<?php echo $i; ?>]" value="<?php echo esc_attr(wp_kses_stripslashes($answer["category"])); ?>" /></td>
                    <td><?php
                        if (isset($answer['catimage']) && $answer['catimage'] == 'remove') {
                            $answer['catimage'] = '';
                        }
                        $media_upload_iframe_src = "media-upload.php?question_id=".$name."&amp;app=wpsqt&amp;TB_iframe=true&amp;cb=" . rand();
                        $image_upload_iframe_src = apply_filters('image_upload_iframe_src', $media_upload_iframe_src."&amp;type=image");
                        ?>
                        <div id="image_<?php echo $name; ?>_link"><a href="<?php echo $image_upload_iframe_src; ?>" id="image_<?php echo $name; ?>_upload" class="thickbox" onclick="setId('<?php echo $name; ?>');" title="<?php echo $name ?>">Select/upload image</a></div>
                        <div class="wpsqt_image" id="image_<?php echo $name; ?>_image"><?php echo stripslashes($answer['catimage']); ?></div>
                        <input type="hidden" name="multiple_image[<?php echo $i; ?>]" id="image_<?php echo $name; ?>_text" value='<?php echo stripcslashes($answer['catimage']); ?>' />
                        <a href="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>&image=remove">Remove Image</a>
                    </td>
                </tr>
			<?php	
					$i++; 
				} ?>
		</tbody>
	</table>
	
	
	<p><a href="#" class="button-secondary" title="Add New Answer" id="wsqt_multi_add">Add New Answer</a></p>
			
</div>