<?php

$entry_id = sanitize_text_field($_GET['entry_id']);
$datas = json_decode(get_post_meta($entry_id, 'rform-entri-data', true), true);
$entry = get_post($entry_id);
$form_id = get_post_meta($entry_id, 'rform-entri-form-id', true);
$form_name = get_the_title($form_id);
$pageID = get_post_meta($entry_id, 'rform-entri-referal', true);
$pageUrl = get_permalink($pageID);

?>

<?php if (class_exists('RomeTheme')) : ?>
    <div class="spacer-2"></div>
    <?php require RomeTheme::plugin_dir() . 'view/header.php'; ?>
    <div class="d-flex flex-column gap-3 me-3  mb-3 rtm-container rounded-2 rtm-bg-gradient-1 rtm-text-font" style="margin-top: -8rem;">
        <div class="px-5 rounded-3 pb-5">
            <div class="spacer"></div>
            <div class="row row-cols-lg-2 row-cols-1 p-4">
                <div class="col col-lg-7">
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex flex-row gap-3 align-items-center ">
                            <h1 class="text-white text-nowrap m-0">
                                Submission
                            </h1>
                            <div class="rtm-divider rounded-pill"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-lg-2 row-cols-1">
                <div class="col col-lg-7">
                    <div class="rtm-border p-3 rounded-3 bg-gradient-1">
                        <h5 class="m-0 text-white"><?php echo esc_html($entry->post_title) ?></h5>
                        <table class="rtm-table table-system">
                            <tbody>
                                <?php
                                foreach ($datas as $key => $value) :
                                    $label = ucwords(str_replace(['-', '_'], ' ', $key))
                                ?>
                                    <tr>
                                        <td scope="row"><?php echo esc_html($label) ?></td>
                                        <td><?php echo (is_array($value)) ? esc_html(implode(' , ', $value)) : esc_html($value) ?></td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col col-lg-5">
                    <div class="rtm-border bg-gradient-1 rounded-3 p-3">
                        <h5 class="m-0 text-white">Additional Info</h5>
                        <table class="rtm-table table-system">
                            <tr>
                                <td>Form Name</td>
                                <td><?php echo esc_html($form_name) ?></td>
                            </tr>
                            <tr>
                                <td>Entry ID</td>
                                <td><?php echo esc_html($entry_id) ?></td>
                            </tr>
                            <tr>
                                <td>Referal Page</td>
                                <td>
                                    <a href="<?php echo esc_url($pageUrl) ?>" class="link-accent"><?php echo esc_html(get_the_title($pageID)) ?></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Entry Date</td>
                                <td>
                                    <?php echo esc_html($entry->post_date) ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>

    <div>
        <h2><?php echo esc_html($entry->post_title) ?></h2>
        <div class="body-container p-3">
            <div class="data-container p-3">
                <div class="data-header w-100 border-bottom">
                    <h5>Data</h5>
                </div>
                <div class="data-body">
                    <?php
                    foreach ($datas as $key => $value) :
                        $label = ucwords(str_replace(['-', '_'], ' ', $key))
                    ?>
                        <div class="p-0 mb-3 bg-white">
                            <h6 class="info-header py-2 px-1 m-0"><?php echo esc_html($label) ?></h6>
                            <span class="py-2 px-1 text-wrap"><?php echo (is_array($value)) ? esc_html(implode(' , ', $value)) : esc_html($value) ?></span>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
            <div class="sidebar">
                <div class="bg-white py-3 px-2">
                    <div class="card-header text-center">
                        <h5>INFO</h5>
                    </div>
                    <div class="px-1">
                        <div class="p-0 mb-3 bg-white">
                            <h6 class="info-header py-2 px-1 m-0">Form Name</h6>
                            <span class="py-2 px-1"><?php echo esc_html($form_name) ?></span>
                        </div>
                        <div class="p-0 mb-3 bg-white">
                            <h6 class="info-header py-2 px-1 m-0">Entry ID</h6>
                            <span class="py-2 px-1"><?php echo esc_html($entry_id) ?></span>
                        </div>
                        <div class="p-0 bg-white">
                            <h6 class="info-header py-2 px-1 m-0">Referal Page</h6>
                            <a href="<?php echo esc_url($pageUrl) ?>" class="py-2 px-1"><?php echo esc_html(get_the_title($pageID)) ?></a>
                        </div>
                    </div>
                </div>
                <div class="bg-white py-3 px-2">
                    Entry Date : <?php echo esc_html($entry->post_date) ?>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            background-color: #f0f0f1;
        }

        .body-container {
            display: flex;
            flex-direction: row;
            justify-content: center;
            width: 100%;
            justify-content: space-between;
            masonry-auto-flow: auto;
        }

        .data-container {
            width: calc(80% - 10px);
            background-color: white;
            height: fit-content;
        }

        .sidebar {
            width: calc(20% - 10px);
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .info-header {
            background-color: #a7d3fc;
        }

        @media only screen and (max-width : 782px) {
            .body-container {
                flex-direction: column;
                gap: 1rem;
            }

            .data-container {
                width: 100%;
            }

            .sidebar {
                width: 100%;
            }
        }
    </style>

<?php endif; ?>