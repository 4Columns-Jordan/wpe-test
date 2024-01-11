<?php
/**
 * Editor functions for the Four Columns Boilerplate.
 * @version 1.0
 */
// =============================================================================
// Getting Theme Colors ========================================================
function FCBP__getThemeColors() {
    $cssFilePath = get_stylesheet_directory() . '/css/general.css'; // Replace with the path to your CSS file
    // Read the CSS file
    $cssContent = file_get_contents($cssFilePath);
    // Find the start and end positions of the relevant comments
    $startComment = '/* = Colors = */';
    $endComment = '/* = Standard Colors = */';
    $startPos = strpos($cssContent, $startComment);
    $endPos = strpos($cssContent, $endComment);
    // Initialize an array to store extracted variables and their values
    $colors = [];
    // If both comments are found, extract the content in between
    if ($startPos !== false && $endPos !== false && $startPos < $endPos) {
        // Extract the content between the comments
        $contentBetweenComments = substr($cssContent, $startPos + strlen($startComment), $endPos - $startPos - strlen($startComment));
        // Define a regular expression pattern to match CSS variables
        $pattern = '/--([a-zA-Z0-9_-]+)\s*:\s*#([a-fA-F0-9]+);/';
        // Use preg_match_all to find all matches in the content between comments
        if (preg_match_all($pattern, $contentBetweenComments, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                // Extract variable name and hex code
                $variableName = str_replace('FC-','',$match[1]);
                $hexCode = '#' . $match[2];
                // Store the variable and its value in the array
                $colors[$variableName] = $hexCode;
            }
        }
    }
    return $colors;
}
// =============================================================================
// Formatting Colors ===========================================================
function FCBP__formatThemeColors() {
    $themeColors = FCBP__getThemeColors();
    $colorArray = array();
    foreach ($themeColors as $color => $hex) {
        $formattedColor = ucwords(str_replace('-', ' ', $color));
        $tempColor = array(
            'name' => __($formattedColor, 'FCBP'),
            'slug' => $color,
            'color' => $hex,
        );
        array_push($colorArray, $tempColor);
    }
    return $colorArray;
}

// =============================================================================
// Registering Colors ==========================================================
function FCBP__addEditorColors() {
    $themeColors = FCBP__formatThemeColors();
    // Adds colors to palette.
    add_theme_support(
        'editor-color-palette',
        $themeColors
    );
}
add_action('after_setup_theme', 'FCBP__addEditorColors');

// =============================================================================
// Adding Colors to ACF Color Picker ===========================================
function FCBP__addAcfColors() {
    $themeColors = FCBP__getThemeColors();
    $colorArray = array();
    foreach ($themeColors as $color) {
        array_push($colorArray, $color);
    }
    $colorArray = json_encode($colorArray);
    ?>
    <script type="text/javascript"> (function($) { acf.add_filter('color_picker_args', function( args, $field ){ 
        // add the hexadecimal codes here for the colors you want to appear as swatches 
        args.palettes = <?php echo $colorArray; ?>
        // return colors 
        return args; }); })(jQuery); 
    </script>
    <?php
}
add_action('acf/input/admin_footer', 'FCBP__addAcfColors');

// =============================================================================
// Formatting Front End Css ====================================================
function FCBP__generateColorPalleteCss() {
	$css                  = '';
	$colorPalette = FCBP__formatThemeColors();
    // This loops throught the pallete and creates the inline styles
	foreach ( $colorPalette as $color ) {
		$css .= <<<CSS
		.has-{$color['slug']}-color{
			--FC-editor-color: {$color['color']};
		}
        .has-{$color['slug']}-background-color{
            --FC-editor-bg-color: {$color['color']};
        }
CSS;
	}
	return $css;
}