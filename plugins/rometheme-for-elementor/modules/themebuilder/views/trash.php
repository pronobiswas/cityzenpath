<?php

$post_types = [];

if (class_exists('RomeThemeForm')) {
    $post_types = ['rometheme_template', 'romethemeform_form']; // Jika kelas ada, gunakan dua post type
} else {
    $post_types = ['rometheme_template']; // Jika kelas tidak ada, gunakan satu post type
}

$args  = [
    'post_type' => $post_types,
    'posts_per_page' => -1,
    'post_status' => ' trash'
];

$post_type = new WP_Query($args);

?>
<div class="rounded-3 rtm-border px-3 bg-gradient-1">
    <table class="rtm-table table-themebuilder">
        <thead>
            <tr>
                <td class="text-center" scope="col">No</td>
                <td scope="col">Title</td>
                <td scope="col">Author</td>
                <td scope="col">Type</td>
                <td scope="col">Date</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $index = 0;
            if ($post_type->have_posts()) {
                while ($post_type->have_posts()) {
                    $index = $index + 1;
                    $post_type->the_post();
                    $id_post =  intval(get_the_ID());
                    $type = get_post_meta($id_post, 'rometheme_template_type', true);
                    $typeAll = ($type != null || !empty($type) || $type != '') ? $type : 'Form';
                    $active = get_post_meta($id_post, 'rometheme_template_active', true);
                    $delete = get_delete_post_link($id_post, '', false);
                    $edit_link = get_edit_post_link($id_post, 'display');
                    $edit_elementor = str_replace('action=edit', 'action=elementor', $edit_link);
                    $status = (get_post_status($id_post) == 'publish') ? 'Published' : 'Draft';
                    echo '<tr>';
                    echo '<td class="text-center">' . esc_html__($index) . '</td>';
                    echo '<td><div>' . esc_html(get_the_title());
                    echo '<span class="badge rounded-pill mx-3 text-bg-secondary">Trash</span>';
                    echo '</div>';

                    require_once(RomeTheme::module_dir() . 'HeaderFooter/HeaderFooter.php');
                    $restore_url = \Rometheme\HeaderFooter\HeaderFooter::get_restore_post_link($id_post);
                    $delete_url = \RomeTheme\HeaderFooter\HeaderFooter::get_delete_permanent_link($id_post);

                    echo '<small><a href="' . esc_url($restore_url) . '">Restore</a>
                            &nbsp;|&nbsp;<a class="link-danger" href="' . esc_url($delete_url) . '">Delete Permanently</a>
                            </small></td>';

                    echo '</td>';
                    echo '<td>' . get_the_author() . '</td>';
                    echo '<td>' . esc_html__(ucwords($typeAll), 'rometheme-for-elementor') . '</td>';
                    echo '<td><small>' . esc_html($status) . '</small><br><small>' . esc_html(get_the_date('Y/m/h') . ' at ' . get_the_date('H:i a')) . '</small></td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td class="text-center" colspan="5">' . esc_html('No Data') . '</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>