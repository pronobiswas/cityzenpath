<!-- Modal -->
<div class="modal fade rtm-text-font" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-3 border-0 shadow p-0">
            <form id="add-new-post" method="POST">
                <input id="action" name="action" type="text" value="addNewPost" hidden>
                <div class="modal-header px-5">
                    <h5 class="modal-title" id="AddModalLabel"><?php esc_html_e('Create New Template', 'rometheme-for-elementor') ?></h5>
                </div>
                <div class="modal-body d-flex flex-column gap-3 px-5 py-4" style="height:24rem">
                    <ul class="nav nav-underline mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item col" role="presentation">
                            <button class="nav-link active w-100" id="general-tab" data-bs-toggle="pill" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">General</button>
                        </li>
                        <li class="nav-item col" role="presentation">
                            <button class="nav-link w-100" id="condition-tab" data-bs-toggle="pill" data-bs-target="#condition" type="button" role="tab" aria-controls="condition" aria-selected="false">Condition</button>
                        </li>
                    </ul>
                    <div class="tab-content overflow-auto" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab" tabindex="0">
                            <div class="mb-3">
                                <label for="inputTitle" class="form-label">Title</label>
                                <input name="title" type="text" class="form-control py-2" id="inputTitle">
                            </div>
                            <div class="mb-3">
                                <label for="inputType" class="form-label">Type</label>
                                <select name="type" class="form-select py-2 select-type" id="inputType">
                                    <option value="header"><?php esc_html_e('Header', 'rometheme-for-elementor') ?></option>
                                    <option value="footer"><?php esc_html_e('Footer', 'rometheme-for-elementor') ?></option>
                                    <?php if (class_exists('RomethemePro') and (\RomethemePro\RproLicense::get_subs_status() === 'active' )) : ?>
                                        <option value="404"><?php esc_html_e('404 Page', 'rometheme-for-elementor') ?></option>
                                    <?php else : ?>
                                        <option value="404" disabled><?php esc_html_e('404 Page (Pro Feature)', 'rometheme-for-elementor') ?></option>
                                    <?php endif; ?>
                                    <?php if (class_exists('RomethemePro') and (\RomethemePro\RproLicense::get_subs_status() === 'active' ) ) : ?>
                                        <option value="single_post"><?php esc_html_e('Single Post', 'rometheme-for-elementor') ?></option>
                                    <?php else : ?>
                                        <option value="single_post" disabled><?php esc_html_e('Single Post (Pro Feature)', 'rometheme-for-elementor') ?></option>
                                    <?php endif; ?>
                                    <?php if (class_exists('RomethemePro') and (\RomethemePro\RproLicense::get_subs_status() === 'active' )) : ?>
                                        <option value="archive"><?php esc_html_e('Archive', 'rometheme-for-elementor') ?></option>
                                    <?php else : ?>
                                        <option value="archive" disabled><?php esc_html_e('Archive (Pro Feature)', 'rometheme-for-elementor') ?></option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="d-flex flex-column gap-3 option">
                                <div class="d-flex flex-row align-items-center justify-content-between gap-3">
                                    <span class="fw-semibold">Active
                                        <p class="m-0 fst-italic text-secondary fw-normal"><small>Enabling or Disabling Templates</small></p>
                                    </span>
                                    <label class="switch">
                                        <input name="active" id="active" class="switch-input" type="checkbox" value="true" checked>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="condition" role="tabpanel" aria-labelledby="condition-tab" tabindex="0">
                            <div class="condition-container">
                                <div class="d-flex justify-content-between align-content-center gap-5">
                                    <div class="d-flex align-items-center"><small>Set the conditions that determine where your template is used.</small></div>
                                    <div>
                                        <button class="btn btn-gradient-accent rounded-3 text-nowrap add-condition">Add +</button>
                                    </div>
                                </div>
                                <div class="conditions d-flex flex-column gap-3 py-3">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-5 border-0 pb-4 pt-0">
                    <button id="close-btn" type="button" class="col btn btn-secondary py-3 rounded-3 " data-bs-dismiss="modal">Close</button>
                    <button id="add-submit-btn" class="col btn btn-gradient-accent py-3 rounded-3 ">Save
                        changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade rtm-text-font" id="ModalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-3">
            <form id="edit_form" method="POST">
                <span id='errfrmMsg' style='margin:0 auto;'></span>
                <input name="id" id="id" type="text" hidden>
                <input id="action" type="text" name="action" value="updatepost" hidden>
                <div class="modal-header border-0 px-5">
                    <h5 class="modal-title" id="EditModalLabel"><?php esc_html_e('Edit Template', 'rometheme-for-elementor') ?></h5>
                </div>
                <div class="modal-body d-flex flex-column gap-3 px-5 py-4" style="height:24rem">
                    <ul class="nav nav-underline mb-3" id="edit-pills-tab" role="tablist">
                        <li class="nav-item col" role="presentation">
                            <button class="nav-link active w-100" id="edit-general-tab" data-bs-toggle="pill" data-bs-target="#edit-general" type="button" role="tab" aria-controls="edit-general" aria-selected="true">General</button>
                        </li>
                        <li class="nav-item col" role="presentation">
                            <button class="nav-link w-100" id="edit-condition-tab" data-bs-toggle="pill" data-bs-target="#edit-condition" type="button" role="tab" aria-controls="edit-condition" aria-selected="false">Condition</button>
                        </li>
                    </ul>
                    <div class="tab-content overflow-auto" id="edit-pills-tabContent">
                        <div class="tab-pane fade show active" id="edit-general" role="tabpanel" aria-labelledby="edit-general-tab" tabindex="0">
                            <div class="mb-3">
                                <label for="inputTitle" class="form-label">Title</label>
                                <input name="title" type="text" class="form-control py-2" id="inputTitle">
                            </div>
                            <div class="mb-3">
                                <label for="inputType" class="form-label">Type</label>
                                <select name="type" class="form-select py-2 select-type" id="inputType">
                                    <option value="header"><?php esc_html_e('Header', 'rometheme-for-elementor') ?></option>
                                    <option value="footer"><?php esc_html_e('Footer', 'rometheme-for-elementor') ?></option>
                                    <?php if (class_exists('RomethemePro') and (\RomethemePro\RproLicense::get_subs_status() === 'active' )) : ?>
                                        <option value="404"><?php esc_html_e('404 Page', 'rometheme-for-elementor') ?></option>
                                    <?php else : ?>
                                        <option value="404" disabled><?php esc_html_e('404 Page (Pro Feature)', 'rometheme-for-elementor') ?></option>
                                    <?php endif; ?>
                                    <?php if (class_exists('RomethemePro') and (\RomethemePro\RproLicense::get_subs_status() === 'active' )) : ?>
                                        <option value="single_post"><?php esc_html_e('Single Post', 'rometheme-for-elementor') ?></option>
                                    <?php else : ?>
                                        <option value="single_post" disabled><?php esc_html_e('Single Post (Pro Feature)', 'rometheme-for-elementor') ?></option>
                                    <?php endif; ?>
                                    <?php if (class_exists('RomethemePro') and (\RomethemePro\RproLicense::get_subs_status() === 'active' )) : ?>
                                        <option value="archive"><?php esc_html_e('Archive', 'rometheme-for-elementor') ?></option>
                                    <?php else : ?>
                                        <option value="archive" disabled><?php esc_html_e('Archive (Pro Feature)', 'rometheme-for-elementor') ?></option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="d-flex flex-column gap-3 option">
                                <div class="d-flex flex-row align-items-center justify-content-between gap-3">
                                    <span class="fw-semibold">Active
                                        <p class="m-0 fst-italic text-secondary fw-normal"><small>Enabling or Disabling Templates</small></p>
                                    </span>
                                    <label class="switch">
                                        <input name="active" id="active" class="switch-input" type="checkbox" value="true" checked>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="edit-condition" role="tabpanel" aria-labelledby="edit-condition-tab" tabindex="0">
                            <div class="condition-container">
                                <div class="d-flex justify-content-between align-content-center gap-5">
                                    <div class="d-flex align-items-center"><small>Set the conditions that determine where your template is used.</small></div>
                                    <div>
                                        <button class="btn btn-gradient-accent rounded-3 text-nowrap add-condition">Add +</button>
                                    </div>
                                </div>
                                <div class="conditions d-flex flex-column gap-3 py-3">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-5 border-0 pb-4 pt-0">
                    <button id="close-btn" type="button" class="col btn btn-secondary py-3 rounded-3" data-bs-dismiss="modal">Close</button>
                    <button id="edit-submit-btn" class="col btn btn-gradient-accent py-3 rounded-3">Save
                        changes</button>
                </div>
            </form>
        </div>
    </div>
</div>