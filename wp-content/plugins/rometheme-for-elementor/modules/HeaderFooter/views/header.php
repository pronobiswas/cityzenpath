<?php

$args  = [
    'post_type' => 'rometheme_template',
    'posts_per_page' => -1,
    'meta_query' => [
        'meta_value' => [
            'key' => 'rometheme_template_type',
            'value' => 'header',
            'compare' => '='
        ]
    ],
];

$post_type = new WP_Query($args);

require \RomeTheme::module_dir() . 'themebuilder/views/modal-btn.php';

?>

<div class="rounded rtm-border px-3 bg-gradient-1">
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
                    $active = get_post_meta($id_post, 'rometheme_template_active', true);
                    $delete = get_delete_post_link($id_post, '', false);
                    $edit_link = get_edit_post_link($id_post, 'display');
                    $edit_elementor = str_replace('action=edit', 'action=elementor', $edit_link);
                    $status = (get_post_status($id_post) == 'publish') ? 'Published' : 'Draft';
                    echo '<tr>';
                    echo '<td class="text-center">' . esc_html__($index) . '</td>';
                    echo '<td><div>' . esc_html(get_the_title());

                    echo ($active == 'true') ? '<span class="badge rounded-pill text-bg-success mx-3">Active</span>' : '<span class="badge rounded-pill mx-3 text-bg-secondary">Inactive</span>';

                    echo '</div>';
                    echo '<small style="font-size: 13px;">
                            <a type="button" class="link" 
                            data-bs-toggle="modal"
                            data-bs-target="#ModalEdit" 
                            data-post-id="' . esc_attr($id_post) . '"
                            data-post-name="' . esc_attr(get_the_title()) . '"
                            data-type="' . esc_attr($type) . '"
                            data-active="' . esc_attr($active) . '"
                            >Edit</a>&nbsp;|&nbsp; <a class="link" href="' . esc_url($edit_elementor) . '">Edit with Elementor</a> &nbsp;|&nbsp;<a class="link link-danger" href="' . esc_url($delete) . '">Trash</a></small>';

                    echo '</td>';
                    echo '<td>' . get_the_author() . '</td>';
                    echo '<td>' . esc_html__(ucwords($type), 'rometheme-for-elementor') . '</td>';
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