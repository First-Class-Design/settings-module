<?php
/**
 * Block Name: Portfolio Gallery
 * Description: A responsive 3-column / 2-column mobile portfolio gallery with touch/drag lightbox, thumbnail strip, and case study link support.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Display an admin notice if ACF Pro is not active.
 */
add_action( 'admin_notices', function() {
    if ( ! function_exists( 'acf_register_block_type' ) ) {
        ?>
        <div class="notice notice-warning is-dismissible">
            <p>
                <strong><?php esc_html_e( 'Portfolio Gallery Block:', 'fcd-settings-modules' ); ?></strong>
                <?php esc_html_e( 'Advanced Custom Fields PRO is required for this block to operate. Please activate ACF PRO.', 'fcd-settings-modules' ); ?>
            </p>
        </div>
        <?php
    }
});

/**
 * Register the Portfolio Gallery custom Gutenberg block type.
 */
add_action( 'acf/init', function() {
    if ( ! function_exists( 'acf_register_block_type' ) ) {
        return;
    }

    acf_register_block_type( [
        'name'            => 'portfolio-gallery',
        'title'           => __( 'Portfolio Gallery', 'fcd-settings-modules' ),
        'description'     => __( 'Responsive 3-column / 2-column mobile portfolio gallery with lightbox and swipe/drag controls.', 'fcd-settings-modules' ),
        'category'        => 'media',
        'icon'            => 'format-gallery',
        'keywords'        => [ 'gallery', 'portfolio', 'lightbox', 'images', 'case study' ],
        'supports'        => [
            'align' => [ 'wide', 'full' ],
            'mode'  => true,
            'jsx'   => true,
        ],
        'render_callback' => 'fcd_sm_portfolio_gallery_render_block',
    ] );
});

/**
 * Render callback for the Portfolio Gallery block.
 * Checks for a theme override (`gallery-section.php`) before defaulting to the module's bundled copy.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview render in Gutenberg.
 * @param int    $post_id    The post ID the block is being rendered on.
 */
function fcd_sm_portfolio_gallery_render_block( $block,$content = '', $is_preview = false,$post_id = 0 ) {
    // Check if the active theme or child theme provides an override template
    // We look in a specific 'fcd-blocks' folder in the theme to keep things tidy
    $template = locate_template( 'fcd-blocks/gallery-section.php' );

    // Fall back to the template file located in the exact same directory as this module
    if ( ! $template ) {$template = plugin_dir_path( __FILE__ ) . 'gallery-section.php';
    }

    if ( file_exists( $template ) ) {
        include $template;
    } else {
        if ( $is_preview ) {
            echo '<p style="color: #ef4444; padding: 1rem; border: 1px dashed #ef4444; text-align: center;">';
            esc_html_e( 'Gallery template file (gallery-section.php) was not found in the plugin or active theme folder.', 'fcd-settings-modules' );
            echo '</p>';
        }
    }
}

/**
 * Automatically register the ACF field groups for the block and attachments.
 */
add_action( 'acf/init', function() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    // 1. Gallery and Display Options on the Gutenberg Block
    acf_add_local_field_group( [
        'key'                   => 'fcd_sm_group_portfolio_gallery_block',
        'title'                 => __( 'Portfolio Gallery Settings', 'fcd-settings-modules' ),
        'fields'                => [
            [
                'key'           => 'fcd_sm_field_portfolio_gallery_images',
                'label'         => __( 'Portfolio Gallery Images', 'fcd-settings-modules' ),
                'name'          => 'portfolio_gallery_images',
                'type'          => 'gallery',
                'instructions'  => __( 'Select or upload images for this portfolio section.', 'fcd-settings-modules' ),
                'required'      => 0,
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'insert'        => 'append',
                'library'       => 'all',
                'min'           => 0,
                'max'           => '',
            ],
            [
                'key'           => 'fcd_sm_field_show_image_titles',
                'label'         => __( 'Show Image Titles', 'fcd-settings-modules' ),
                'name'          => 'show_image_titles',
                'type'          => 'true_false',
                'instructions'  => __( 'Display image titles on hover overlay in the gallery grid.', 'fcd-settings-modules' ),
                'message'       => __( 'Enable title overlays', 'fcd-settings-modules' ),
                'default_value' => 1,
                'ui'            => 1,
                'ui_on_text'    => __( 'Show', 'fcd-settings-modules' ),
                'ui_off_text'   => __( 'Hide', 'fcd-settings-modules' ),
            ],
            [
                'key'           => 'fcd_sm_field_full_width_gallery',
                'label'         => __( 'Full Width Gallery', 'fcd-settings-modules' ),
                'name'          => 'full_width_gallery',
                'type'          => 'true_false',
                'instructions'  => __( 'Stretch gallery across the full viewport width (100vw).', 'fcd-settings-modules' ),
                'message'       => __( 'Enable full width breakout', 'fcd-settings-modules' ),
                'default_value' => 0,
                'ui'            => 1,
                'ui_on_text'    => __( 'Full', 'fcd-settings-modules' ),
                'ui_off_text'   => __( 'Boxed', 'fcd-settings-modules' ),
            ],
        ],
        'location'              => [
            [
                [
                    'param'    => 'block',
                    'operator' => '==',
                    'value'    => 'acf/portfolio-gallery',
                ],
            ],
        ],
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
    ] );

    // 2. Case Study URL Field on Media Attachments
    acf_add_local_field_group( [
        'key'                   => 'fcd_sm_group_media_case_study_url',
        'title'                 => __( 'Portfolio Case Study Link', 'fcd-settings-modules' ),
        'fields'                => [
            [
                'key'           => 'fcd_sm_field_attachment_case_study_url',
                'label'         => __( 'Case Study URL', 'fcd-settings-modules' ),
                'name'          => 'case_study_url',
                'type'          => 'link',
                'instructions'  => __( 'Optional: Add a case study link. Displays a button in the fullscreen lightbox (hidden automatically on case-study pages).', 'fcd-settings-modules' ),
                'required'      => 0,
                'return_format' => 'array',
            ],
        ],
        'location'              => [
            [
                [
                    'param'    => 'attachment',
                    'operator' => '==',
                    'value'    => 'all',
                ],
            ],
        ],
        'menu_order'            => 10,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
    ] );
});