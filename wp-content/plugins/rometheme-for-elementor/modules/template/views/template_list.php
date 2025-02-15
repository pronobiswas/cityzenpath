<div class="d-flex flex-column gap-3 me-3  mb-3 rtm-container rounded-2 rtm-bg-gradient-1 rtm-text-font" style="margin-top: -8rem;">
    <div class="px-5 rounded-3 pb-5">
        <div class="spacer"></div>
        <div class="row row-cols-lg-2 row-cols-1 p-4">
            <div class="col col-lg-7">
                <div class="d-flex flex-column gap-3">
                    <span class="accent-color">Build the Future</span>
                    <div class="d-flex flex-row gap-3 align-items-center ">
                        <h1 class="text-white text-nowrap m-0">
                            Templates
                        </h1>
                        <div class="rtm-divider rounded-pill"></div>
                    </div>
                    <p class="text">
                        A Template Kit is a collection of pre-designed templates that help you create a full website for a specific industry. It includes all the pages, parts, settings, and content that you'd expect in a fully functional website.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="rtm-bg-gradient-1 rounded-3 me-3">
    <ul class="nav sub-nav py-3 px-5 rtm-border-bottom" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-template-tab" data-bs-toggle="pill" data-bs-target="#pills-template" type="button" role="tab" aria-controls="pills-template" aria-selected="true">Template</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-installed-template-tab" data-bs-toggle="pill" data-bs-target="#pills-installed-template" type="button" role="tab" aria-controls="pills-installed-template" aria-selected="false">Installed Template</button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane px-5 py-3 fade show active" id="pills-template" role="tabpanel" aria-labelledby="pills-template-tab" tabindex="0">
            <div class="d-flex flex-row justify-content-between">
                <div class="col-4">
                    <div class="position-relative template-category-container">
                        <input id="template-category" name="search" type="text" class="form-control py-1" readonly value="<?php echo (isset($_GET['category'])) ? esc_attr(ucwords(str_replace('-', ' ', $_GET['category']))) : 'All Categories' ?>">
                        <div id="template-category-list" class="glass-effect">
                            <div class="row row-cols-2">
                                <div class="col mb-2">
                                    <a href="<?php echo esc_url(admin_url('admin.php?page=rtmkit-templates')) ?>" class="template-category-item">All Categories</a>
                                </div>
                                <?php foreach (\RomethemeKit\Template::get_template_category()['rtm_templatekit_category'] as $category) : ?>
                                    <div class="col mb-2">
                                        <a href="<?php echo esc_url(admin_url("admin.php?page=rtmkit-templates&category=$category")) ?>" class="template-category-item"><?php echo esc_html(ucwords(str_replace('-', ' ', $category))) ?></a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <form action="<?php echo esc_url(admin_url('admin.php?')) ?>">
                        <div class="input-group mb-3">
                            <input type="text" name="page" value="rtmkit-templates" hidden>
                            <input id="template-search" name="search" type="text" class="form-control rounded-start" placeholder="Search All Template Kits...">
                            <button class="btn btn-gradient-accent border-0 rounded-end" type="submit" id="button-addon2"><i class="rtmicon rtmicon-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row row-cols-3" id="template-container">
                <div class="w-100 d-flex justify-content-center align-items-center" id="loader" style="height: 500px;">
                    <div class="spinner-border text-light" style="width: 3rem; height: 3rem;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <ul id="pagination" class="pagination justify-content-center my-3"></ul>
        </div>
        <div class="tab-pane fade" id="pills-installed-template" role="tabpanel" aria-labelledby="pills-installed-template-tab" tabindex="0">
            <?php require_once RomeTheme::module_dir() . 'template/views/installed_template_list.php';  ?>
        </div>
    </div>
</div>