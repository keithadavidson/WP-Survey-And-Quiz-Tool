        <?php
            if ( isset($question['orientation']) ){
                $orientation = 'td';
                ?><table><tr><?php
            } else {
                $orientation = 'li';
                ?><ul class="wpsqt_multiple_question"><?php
            }?>

            <?php foreach ( $question['answers'] as $answerKey => $answer ){
                ?>
                <<?php echo $orientation; ?>>
                    <?php if ( isset($answer['image']) ){ ?>
                    <p><?php echo stripslashes($answer['image']); ?></p>
                    <?php } ?>
					<input type="<?php echo ($question['type'] == 'Single' ) ? 'radio' : 'checkbox'; ?>"
                           name="answers[<?php echo $questionKey; ?>][]"
                           value="<?php echo $answerKey; ?>"
                           id="answer_<?php echo $question['id']; ?>_<?php echo $answerKey;?>" <?php if ( (isset($answer['default']) && $answer['default'] == 'yes') || in_array($answerKey, $givenAnswer)) {  ?>
                           checked="checked" <?php } ?> />
                    <label for="answer_<?php echo $question['id']; ?>_<?php echo $answerKey;?>"><?php echo esc_html( $answer['text'] ); ?></label>
                    <?php
                    if ( isset($answer['catimage']) ){ ?>
                        <p><?php echo stripslashes($answer['catimage']); ?></p
                    <?php } ?>
				</<?php echo $orientation; ?>>

			<?php } 
				if (    $question['type'] == 'Multiple Choice' 
					 && array_key_exists('include_other',$question)
					 && $question['include_other'] == 'yes' ){					
				?>
				<li>
                    ## TODO: add ability for horizontial list
					<input type="checkbox"
                           name="answers[<?php echo $questionKey; ?>]"
                           value="0"
                           id="answer_<?php echo $question['id']; ?>_other">
                    <label for="answer_<?php echo $question['id']; ?>_other">Other</label>
                    <input type="text"
                           name="other[<?php echo $questionKey; ?>]"
                           value="" />
				</li>
				<?php }
            if ( isset($question['orientation']) ){
                ?></tr></table><?php
            } else {
                ?></ul><?php
            }?>
