<?php
    $categories_total = array();

    $chartWidth = get_option('wpsqt_chart_width');
    $chartHeight = get_option('wpsqt_chart_height');
    $chartTextColour = get_option('wpsqt_chart_text_colour');
    $chartTextSize = get_option('wpsqt_chart_text_size');
    $chartAbbreviations = get_option('wpsqt_chart_abbreviation');
    if (!isset($chartWidth) || $chartWidth == NULL)
        $chartWidth = 400;
    if (!isset($chartHeight) || $chartHeight == NULL)
        $chartHeight = 185;
    if (!isset($chartTextColour) || $chartTextColour == NULL)
        $chartTextColour = '000000';
    if (!isset($chartTextSize) || $chartTextSize == NULL)
        $chartTextSize = 13;
    $chartSize = 'chs='.$chartWidth.'x'.$chartHeight;

    foreach ( $result['sections'] as $section ){ ?>
    <h3><?php echo $section['name']; ?></h3>

    <?php
    if ( $section == false ) { ?>

	    <p>There are no results for this section yet.</p>

    <?php } else { ?>

	<?php
            $categories  = array();
            $googleChartUrl = 'http://chart.apis.google.com/chart?'.$chartSize.'&chxs=0,'.$chartTextColour.','.$chartTextSize.',0,lt,'.$chartTextColour.'|1,'.$chartTextColour.','.$chartTextSize.',1,lt,'.$chartTextColour.'&cht=p3&chf=bg,s,'.get_option("wpsqt_chart_bg").'&chco='.get_option("wpsqt_chart_colour");
            foreach ( $section['questions'] as $questonKey => $question ) {

                $questionId = $question['id'];
                $value = $question['points'];

                if ( $question['type'] == "Single" || $question['type'] == 'Multiple') {

                    $category = $question['answers'][$section['answers'][$questionId]['given'][0]]['category'];
                    $categories[$category] += $value;
                    $categories_total[$category] += $value;

                }
                else if ($question['type'] == "Likert") {
                    $maxValue = 0;
                    $given = $question['answers'][$questionId]['given']/$question['scale'];
                    $category = $question['category'];
                    $categories[$category] += $value * $given;
                    $categories_total[$category] += $value * $given;


                } else if ($question['type'] == "Likert Matrix") {

                    $valueArray    = array();
                    $nameArray     = array();
                    $maxValue = 0;
                    $numAnswers = count($question['answers']);

                    foreach ($matrixOption as $key => $answer) {
                        $nameArray[] = $key;
                        $valueArray[] = $answer['count'];
                        // Gets the maximum value
                        if ($answer['count'] > $maxValue)
                            $maxValue = $answer['count'];
                    }
                }
            }


            $googleChartUrl .= '&chd=t:'.implode(',', $categories);
            $googleChartUrl .= '&chl='.implode('|',array_keys($categories));

            ?><img src="<?php echo $googleChartUrl; ?>" alt="<?php echo $section['name']; ?>" /><?php
        ?><p>"<?php print_r($categories); ?>"</p><?php
        }
	}

    $googleChartUrl = 'http://chart.apis.google.com/chart?'.$chartSize.'&chxs=0,'.$chartTextColour.','.$chartTextSize.',0,lt,'.$chartTextColour.'|1,'.$chartTextColour.','.$chartTextSize.',1,lt,'.$chartTextColour.'&cht=p3&chf=bg,s,'.get_option("wpsqt_chart_bg").'&chco='.get_option("wpsqt_chart_colour");

    $googleChartUrl .= '&chd=t:'.implode(',', $categories_total);
    $googleChartUrl .= '&chl='.implode('|',array_keys($categories_total));

?>
    <img src="<?php echo $googleChartUrl; ?>" alt="Total Result" /><?php
    ?><p>"<?php print_r($categories_total); ?>"</p><?php
?>
