<div class="spacer-2"></div>
<?php
$paged = isset($_GET['paged']) ? sanitize_text_field(intval($_GET['paged'])) : 1;
$args = [
    'post_type' => 'romethemeform_entry',
    'posts_per_page' => get_option('posts_per_page'),
    'paged' => $paged
];

if (isset($_GET['rform_id'])) {
    $args['meta_query'] = ['meta_value' => [
        'key' => 'rform-entri-form-id',
        'value' => sanitize_text_field($_GET['rform_id']),
        'compare' => '='
    ]];
}

$entries = new WP_Query($args);

require_once(RomeTheme::plugin_dir() . 'view/header.php');
?>

<?php if (class_exists('Rometheme')) : ?>
    <div class="d-flex flex-column gap-3 me-3  mb-3 rtm-container rounded-2 rtm-bg-gradient-1 rtm-text-font" style="margin-top: -8rem;">
        <div class="px-5 rounded-3 pb-5">
            <div class="spacer"></div>
            <div class="row row-cols-lg-2 row-cols-1 p-4">
                <div class="col col-lg-7">
                    <div class="d-flex flex-column gap-3">
                        <span class="accent-color">Build the Future</span>
                        <div class="d-flex flex-row gap-3 align-items-center ">
                            <h1 class="text-white text-nowrap m-0">
                                Submissions
                            </h1>
                            <div class="rtm-divider rounded-pill"></div>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-5">
                    <div class="d-flex justify-content-end align-items-end h-100 gap-1 mb-3">
                        <?php
                        $total_pages = $entries->max_num_pages;
                        $current_url = add_query_arg(array()); // get the current URL
                        $base_url = remove_query_arg('paged', $current_url);
                        if ($total_pages > 1) {
                            $current_page = max(1, intval(sanitize_text_field($_GET['paged'])));
                            echo '<div class="entries-pagination">';
                            echo paginate_links(array(
                                'base' => $base_url . '&paged=%#%',
                                'format' => '&paged=%#%',
                                'current' => $current_page,
                                'total' => $total_pages,
                                'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                 <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
               </svg>',
                                'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                 <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
               </svg>',
                            ));
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="w-100 p-3">
                <div class="w-100 rtm-border px-4 rounded-3 ">
                    <table class="rtm-table table-themebuilder">
                        <thead>
                            <tr>
                                <td class="text-center" scope="col">No</td>
                                <td scope="col">Title</td>
                                <td scope="col">Form Name</td>
                                <td scope="col">Referal</td>
                                <td scope="col">Date</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = (intval($paged) * 10) - 10;
                            if ($entries->have_posts()) {
                                while ($entries->have_posts()) {
                                    $index = $index + 1;
                                    $no = (string) $index;
                                    $entries->the_post();
                                    $entries->the_posts_pagination();
                                    $entry_id = get_the_ID();
                                    $form_id = get_post_meta($entry_id, 'rform-entri-form-id', true);
                                    $form_name = get_the_title($form_id);
                                    $page_id = get_post_meta($entry_id, 'rform-entri-referal', true);
                                    $page_name = get_the_title($page_id);
                                    $status =  (get_post_status($entry_id) == 'publish') ? 'Published' : 'Draft';
                                    $entry_title = get_the_title();
                                    $delete = get_delete_post_link($entry_id, '', false);
                                    echo '<tr>';
                                    echo '<td class="text-center" scope="col">' . esc_html($no) . '</td>';
                                    echo '<td><div>' . esc_html__($entry_title, 'romethemeform') . '</div><small style="font-size:13px">
                        <a href="' . esc_url(admin_url('admin.php?page=romethemeform-entries&entry_id=' . $entry_id)) . '">View</a>&nbsp; | &nbsp <a class="link-danger" href="' . esc_url($delete) . '">Trash</a>
                        </small></td>';
                                    echo '<td>' . esc_html($form_name) . '</td>';
                                    echo '<td>' . esc_html($page_name) . '</td>';
                                    echo '<td>
                        <div>' . esc_html($status) . '</div>
                        <small>' . esc_html(get_the_date('Y/m/d') . ' at ' . get_the_date('H:i a')) . '</small>
                        </td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td class="text-center" colspan="5">' . esc_html('No Entries') . '</td></tr>';
                            }
                            wp_reset_postdata();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php else : ?>

    <div class="w-100 p-3">
        <div class="d-flex justify-content-between gap-1 mb-3">
            <h2>Entries</h2>
            <?php
            $total_pages = $entries->max_num_pages;
            $current_url = add_query_arg(array()); // get the current URL
            $base_url = remove_query_arg('paged', $current_url);
            if ($total_pages > 1) {
                $current_page = max(1, intval(sanitize_text_field($_GET['paged'])));
                echo '<div class="entries-pagination">';
                echo paginate_links(array(
                    'base' => $base_url . '&paged=%#%',
                    'format' => '&paged=%#%',
                    'current' => $current_page,
                    'total' => $total_pages,
                    'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                 <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
               </svg> Previous',
                    'next_text' => 'Next <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                 <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
               </svg>',
                ));
                echo '</div>';
            }
            ?>
        </div>
        <div class="w-100">
            <table class="table shadow table-sm">
                <thead class="bg-white">
                    <tr>
                        <td class="text-center" scope="col">No</td>
                        <td scope="col">Title</td>
                        <td scope="col">Form Name</td>
                        <td scope="col">Referal</td>
                        <td scope="col">Date</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $index = (intval($paged) * 10) - 10;
                    if ($entries->have_posts()) {
                        while ($entries->have_posts()) {
                            $index = $index + 1;
                            $no = (string) $index;
                            $entries->the_post();
                            $entries->the_posts_pagination();
                            $entry_id = get_the_ID();
                            $form_id = get_post_meta($entry_id, 'rform-entri-form-id', true);
                            $form_name = get_the_title($form_id);
                            $page_id = get_post_meta($entry_id, 'rform-entri-referal', true);
                            $page_name = get_the_title($page_id);
                            $status =  (get_post_status($entry_id) == 'publish') ? 'Published' : 'Draft';
                            $entry_title = get_the_title();
                            $delete = get_delete_post_link($entry_id, '', false);
                            echo '<tr>';
                            echo '<td class="text-center" scope="col">' . esc_html($no) . '</td>';
                            echo '<td><div>' . esc_html__($entry_title, 'romethemeform') . '</div><small style="font-size:13px">
                        <a href="' . esc_url(admin_url('admin.php?page=romethemeform-entries&entry_id=' . $entry_id)) . '">View</a>&nbsp; | &nbsp <a class="link-danger" href="' . esc_url($delete) . '">Trash</a>
                        </small></td>';
                            echo '<td>' . esc_html($form_name) . '</td>';
                            echo '<td>' . esc_html($page_name) . '</td>';
                            echo '<td>
                        <div>' . esc_html($status) . '</div>
                        <small>' . esc_html(get_the_date('Y/m/d') . ' at ' . get_the_date('H:i a')) . '</small>
                        </td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td class="text-center" colspan="4">' . esc_html('No Entries') . '</td></tr>';
                    }
                    wp_reset_postdata();
                    ?>
                </tbody>
                <tfoot>
                    <tr class="bg-white">
                        <td scope="col"></td>
                        <td scope="col">Title</td>
                        <td scope="col">Form Name</td>
                        <td scope="col">Referal</td>
                        <td scope="col">Date</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <style>
        body {
            background-color: #f0f0f1;
        }

        .page-numbers {
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
        }

        .page-numbers:hover {
            background-color: #ddd;
        }

        .entries-pagination {
            display: flex;
            align-items: center;
        }

        .entries-pagination .current {
            background-color: var(--bs-blue);
            color: white;
        }
    </style>
<?php endif; ?>