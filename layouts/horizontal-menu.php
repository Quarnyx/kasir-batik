<header id="page-topbar" class="ishorizontal-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.php" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.svg" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-sm.svg" alt="" height="22"> <span class="logo-txt">Symox</span>
                    </span>
                </a>

                <a href="index.php" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.svg" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-sm.svg" alt="" height="22"> <span class="logo-txt">Symox</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <div class="topnav">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
        
                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle arrow-none" href="index.php" id="topnav-dashboard" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class='bx bx-tachometer'></i>
                                    <span data-key="t-dashboards"><?php echo $language["Dashboard"]; ?></span>
                                </a>
                            </li>
        
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <i class='bx bx-grid-alt'></i>
                                    <span data-key="t-apps"><?php echo $language["Apps"]; ?></span> <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">
    
                                    <a href="apps-calendar.php" class="dropdown-item" data-key="t-calendar"><?php echo $language["Calendar"]; ?></a>
                                    <a href="apps-chat.php" class="dropdown-item" data-key="t-chat"><?php echo $language["Chat"]; ?></a>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                            role="button">
                                            <span data-key="t-email"><?php echo $language["Email"]; ?></span> <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-email">
                                            <a href="email-inbox.php" class="dropdown-item" data-key="t-inbox"><?php echo $language["Inbox"]; ?></a>
                                            <a href="email-read.php" class="dropdown-item" data-key="t-read-email"><?php echo $language["Read_Email"]; ?></a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ecommerce"
                                            role="button">
                                            <?php echo $language["Ecommerce"]; ?> <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-ecommerce">
                                            <a href="ecommerce-products.php" class="dropdown-item" data-key="t-products"><?php echo $language["Products"]; ?></a>
                                            <a href="ecommerce-product-detail.php" class="dropdown-item" data-key="t-product-detail"><?php echo $language["Product_Detail"]; ?></a>
                                            <a href="ecommerce-orders.php" class="dropdown-item" data-key="t-orders"><?php echo $language["Orders"]; ?></a>
                                            <a href="ecommerce-customers.php" class="dropdown-item" data-key="t-customers"><?php echo $language["Customers"]; ?></a>
                                            <a href="ecommerce-cart.php" class="dropdown-item" data-key="t-cart"><?php echo $language["Cart"]; ?></a>
                                            <a href="ecommerce-checkout.php" class="dropdown-item" data-key="t-checkout"><?php echo $language["Checkout"]; ?></a>
                                            <a href="ecommerce-shops.php" class="dropdown-item" data-key="t-shops"><?php echo $language["Shops"]; ?></a>
                                            <a href="ecommerce-add-product.php" class="dropdown-item" data-key="t-add-product"><?php echo $language["Add_Product"]; ?></a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-invoice"
                                            role="button"><span data-key="t-invoices"><?php echo $language["Invoices"]; ?></span> <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-invoice">
                                            <a href="invoices-list.php" class="dropdown-item" data-key="t-invoice-list"><?php echo $language["Invoice_List"]; ?></a>
                                            <a href="invoices-detail.php" class="dropdown-item" data-key="t-invoice-detail"><?php echo $language["Invoice_Detail"]; ?></a>
                                        </div>
                                    </div>
    
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-contact"
                                            role="button">
                                           <span data-key="t-contacts"><?php echo $language["Contacts"]; ?></span> <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-contact">
                                            <a href="contacts-grid.php" class="dropdown-item" data-key="t-user-grid"><?php echo $language["User_Grid"]; ?></a>
                                            <a href="contacts-list.php" class="dropdown-item" data-key="t-user-list"><?php echo $language["User_List"]; ?></a>
                                            <a href="contacts-profile.php" class="dropdown-item" data-key="t-user-settings"><?php echo $language["Profile"]; ?></a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class='bx bxl-bootstrap'></i>
                                   <span data-key="t-bootstrap"><?php echo $language["Bootstrap"]; ?></span> <div class="arrow-down"></div>
                                </a>
    
                                <div class="dropdown-menu mega-dropdown-menu px-2 dropdown-mega-menu-xl" aria-labelledby="topnav-uielement">
                                    <div class="ps-2 p-lg-0">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div>
                                                    <div class="menu-title"><?php echo $language["Components"]; ?></div>
                                                    <div class="row g-0">
                                                        <div class="col-lg-4">
                                                            <div>
                                                                <a href="ui-alerts.php" class="dropdown-item" data-key="t-alerts"><?php echo $language["Alerts"]; ?></a>
                                                                <a href="ui-buttons.php" class="dropdown-item" data-key="t-buttons"><?php echo $language["Buttons"]; ?></a>
                                                                <a href="ui-cards.php" class="dropdown-item" data-key="t-cards"><?php echo $language["Cards"]; ?></a>
                                                                <a href="ui-carousel.php" class="dropdown-item" data-key="t-carousel"><?php echo $language["Carousel"]; ?></a>
                                                                <a href="ui-dropdowns.php" class="dropdown-item" data-key="t-dropdowns"><?php echo $language["Dropdowns"]; ?></a>
                                                                <a href="ui-grid.php" class="dropdown-item" data-key="t-grid"><?php echo $language["Grid"]; ?></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div>
                                                                <a href="ui-images.php" class="dropdown-item" data-key="t-images"><?php echo $language["Images"]; ?></a>
                                                                <a href="ui-modals.php" class="dropdown-item" data-key="t-modals"><?php echo $language["Modals"]; ?></a>
                                                                <a href="ui-offcanvas.php" class="dropdown-item" data-key="t-offcanvas"><?php echo $language["Offcanvas"]; ?></a>
                                                                <a href="ui-placeholders.php" class="dropdown-item" data-key="t-placeholders"><?php echo $language["Placeholders"]; ?></a>
                                                                <a href="ui-progressbars.php" class="dropdown-item" data-key="t-progress-bars"><?php echo $language["Progress_Bars"]; ?></a>
                                                                <a href="ui-tabs-accordions.php" class="dropdown-item" data-key="t-tabs-accordions"><?php echo $language["Tabs_n_Accordions"]; ?></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <a href="ui-typography.php" class="dropdown-item" data-key="t-typography"><?php echo $language["Typography"]; ?></a>
                                                            <a href="ui-video.php" class="dropdown-item" data-key="t-video"><?php echo $language["Video"]; ?></a>
                                                            <a href="ui-general.php" class="dropdown-item" data-key="t-general"><?php echo $language["General"]; ?></a>
                                                            <a href="ui-colors.php" class="dropdown-item" data-key="t-colors"><?php echo $language["Colors"]; ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
        
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button"
                                >
                                    <i class='bx bx-layer' ></i>
                                    <span data-key="t-components"><?php echo $language["Components"]; ?></span> <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-components">
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-extended"
                                            role="button">
                                            <span data-key="t-extendeds"><?php echo $language["Extended"]; ?></span> <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-form">
                                            <a href="extended-lightbox.php" class="dropdown-item" data-key="t-lightbox"><?php echo $language["Lightbox"]; ?></a>
                                            <a href="extended-rangeslider.php" class="dropdown-item" data-key="t-range-slider"><?php echo $language["Range_Slider"]; ?></a>
                                            <a href="extended-sweet-alert.php" class="dropdown-item" data-key="t-sweet-alert"><?php echo $language["SweetAlert_2"]; ?></a>
                                            <a href="extended-rating.php" class="dropdown-item" data-key="t-rating"><?php echo $language["Rating"]; ?></a>
                                            <a href="extended-notifications.php" class="dropdown-item" data-key="t-notifications"><?php echo $language["Notifications"]; ?></a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-form"
                                            role="button">
                                            <span data-key="t-forms"><?php echo $language["Forms"]; ?></span> <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-form">
                                            <a href="form-elements.php" class="dropdown-item"  data-key="t-basic-elements"><?php echo $language["Basic_Elements"]; ?></a>
                                            <a href="form-validation.php" class="dropdown-item" data-key="t-validation"><?php echo $language["Validation"]; ?></a>
                                            <a href="form-advanced.php" class="dropdown-item" data-key="t-advanced-plugins"><?php echo $language["Advanced_Plugins"]; ?></a>
                                            <a href="form-editors.php" class="dropdown-item" data-key="t-editors"><?php echo $language["Editors"]; ?></a>
                                            <a href="form-uploads.php" class="dropdown-item" data-key="t-file-upload"><?php echo $language["File_Upload"]; ?></a>
                                            <a href="form-wizard.php" class="dropdown-item" data-key="t-wizard"><?php echo $language["Wizard"]; ?></a>
                                            <a href="form-mask.php" class="dropdown-item"  data-key="t-mask"><?php echo $language["Mask"]; ?></a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-table"
                                            role="button">
                                            <span data-key="t-tables"><?php echo $language["Tables"]; ?></span> <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-table">
                                            <a href="tables-basic.php" class="dropdown-item" data-key="t-bootstrap-basic"><?php echo $language["Bootstrap_Basic"]; ?></a>
                                            <a href="tables-advanced.php" class="dropdown-item" data-key="t-advanced-tables"><?php echo $language["Advance_Tables"]; ?></a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-charts"
                                            role="button">
                                            <span data-key="t-charts"><?php echo $language["Charts"]; ?></span> <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-charts">
                                            <a href="charts-apex.php" class="dropdown-item" data-key="t-apex-charts"><?php echo $language["Apex"]; ?></a>
                                            <a href="charts-chartjs.php" class="dropdown-item" data-key="t-chartjs-charts"><?php echo $language["Chartjs"]; ?></a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-icons"
                                            role="button">
                                            <span data-key="t-icons"><?php echo $language["Icons"]; ?></span> <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-icons">
                                            <a href="icons-feather.php" class="dropdown-item" data-key="t-feather"><?php echo $language["Feather"]; ?></a>
                                            <a href="icons-boxicons.php" class="dropdown-item" data-key="t-boxicons"><?php echo $language["Boxicons"]; ?></a>
                                            <a href="icons-materialdesign.php" class="dropdown-item" data-key="t-material-design"><?php echo $language["Material_Design"]; ?></a>
                                            <a href="icons-dripicons.php" class="dropdown-item" data-key="t-dripicons"><?php echo $language["Dripicons"]; ?></a>
                                            <a href="icons-fontawesome.php" class="dropdown-item" data-key="t-font-awesome"><?php echo $language["Font_awesome"]; ?></a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-map"
                                            role="button">
                                            <span data-key="t-maps"><?php echo $language["Maps"]; ?></span> <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-map">
                                            <a href="maps-google.php" class="dropdown-item" data-key="t-google"><?php echo $language["Google"]; ?></a>
                                            <a href="maps-vector.php" class="dropdown-item" data-key="t-vector"><?php echo $language["Vector"]; ?></a>
                                            <a href="maps-leaflet.php" class="dropdown-item" data-key="t-leaflet"><?php echo $language["Leaflet"]; ?></a>
                                        </div>
                                    </div>
                                </div>
                               
                            </li>
        
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button">
                                <i class='bx bx-file'></i>
                                    <span data-key="t-pages"><?php echo $language["Pages"]; ?></span> <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-more">
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth"
                                            role="button">
                                            <span data-key="t-authentication"><?php echo $language["Authentication"]; ?></span> <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-auth">
                                            <a href="page-login.php" class="dropdown-item" data-key="t-login"><?php echo $language["Login"]; ?></a>
                                            <a href="page-register.php" class="dropdown-item" data-key="t-register"><?php echo $language["Register"]; ?></a>
                                            <a href="page-recoverpw.php" class="dropdown-item" data-key="t-recover-password"><?php echo $language["Recover_Password"]; ?></a>
                                            <a href="auth-lock-screen.php" class="dropdown-item" data-key="t-lock-screen"><?php echo $language["Lock_Screen"]; ?></a>
                                            <a href="auth-logout.php" class="dropdown-item" data-key="t-logout"><?php echo $language["Log_Out"]; ?></a>
                                            <a href="auth-confirm-mail.php" class="dropdown-item" data-key="t-confirm-mail"><?php echo $language["Confirm_Mail"]; ?></a>
                                            <a href="auth-email-verification.php" class="dropdown-item" data-key="t-email-verification"><?php echo $language["Email_Verification"]; ?></a>
                                            <a href="auth-two-step-verification.php" class="dropdown-item" data-key="t-two-step-verification"><?php echo $language["Two_Step_Verification"]; ?></a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-utility"
                                            role="button">
                                            <span data-key="t-utility"><?php echo $language["Utility"]; ?></span> <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-utility">
                                            <a href="pages-starter.php" class="dropdown-item" data-key="t-starter-page"><?php echo $language["Starter_Page"]; ?></a>
                                            <a href="pages-maintenance.php" class="dropdown-item" data-key="t-maintenance"><?php echo $language["Maintenance"]; ?></a>
                                            <a href="pages-comingsoon.php" class="dropdown-item" data-key="t-coming-soon"><?php echo $language["Coming_Soon"]; ?></a>
                                            <a href="pages-timeline.php" class="dropdown-item" data-key="t-timeline"><?php echo $language["Timeline"]; ?></a>
                                            <a href="pages-faqs.php" class="dropdown-item" data-key="t-faqs"><?php echo $language["FAQs"]; ?></a>
                                            <a href="pages-pricing.php" class="dropdown-item" data-key="t-pricing"><?php echo $language["Pricing"]; ?></a>
                                            <a href="pages-404.php" class="dropdown-item" data-key="t-error-404"><?php echo $language["Error_404"]; ?></a>
                                            <a href="pages-500.php" class="dropdown-item" data-key="t-error-500"><?php echo $language["Error_500"]; ?></a>
                                        </div>
                                    </div>

                                    <a href="layouts-vertical.php" class="dropdown-item" data-key="t-vertical"><?php echo $language["Vertical"]; ?></a>
                                </div>
                            </li>
        
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-sm" data-feather="search"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
                    <form class="p-3">
                        <div class="search-box">
                            <div class="position-relative">
                                <input type="text" class="form-control rounded" placeholder="<?php echo $language["Search_here"] ?>...">
                                <i class="mdi mdi-magnify search-icon"></i>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="dropdown d-inline-block language-switch">
            <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php if ($lang == 'en') { ?>
                        <img src="assets/images/flags/us.jpg" alt="Header Language" height="16">
                    <?php } ?>
                    <?php if ($lang == 'es') { ?>
                        <img src="assets/images/flags/spain.jpg" alt="Header Language" height="16">
                    <?php } ?>
                    <?php if ($lang == 'de') { ?>
                        <img src="assets/images/flags/germany.jpg" alt="Header Language" height="16">
                    <?php } ?>
                    <?php if ($lang == 'it') { ?>
                        <img src="assets/images/flags/italy.jpg" alt="Header Language" height="16">
                    <?php } ?>
                    <?php if ($lang == 'ru') { ?>
                        <img src="assets/images/flags/russia.jpg" alt="Header Language" height="16">
                    <?php } ?>
                </button>
                <div class="dropdown-menu dropdown-menu-end">

                   <!-- item-->
                   <a href="?lang=en" class="dropdown-item notify-item">
                        <img src="assets/images/flags/us.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle"> English </span>
                    </a>
                    
                    <!-- item-->
                    <a href="?lang=de" class="dropdown-item notify-item">
                        <img src="assets/images/flags/germany.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle"> German </span>
                    </a>

                    <!-- item-->
                    <a href="?lang=it" class="dropdown-item notify-item">
                        <img src="assets/images/flags/italy.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle"> Italian </span>
                    </a>

                    <!-- item-->
                    <a href="?lang=es" class="dropdown-item notify-item">
                        <img src="assets/images/flags/spain.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle"> Spanish </span>
                    </a>

                     <!-- item-->
                     <a href="?lang=ru" class="dropdown-item notify-item">
                        <img src="assets/images/flags/russia.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle"> Russian </span>
                    </a>

                </div>
            </div>
            
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-sm" data-feather="bell"></i>
                    <span class="noti-dot bg-danger rounded-pill">3</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="m-0 font-size-15"> <?php echo $language["Notifications"]; ?> </h5>
                            </div>
                            <div class="col-auto">
                                <a href="javascript:void(0);" class="small"> <?php echo $language["Mark_all_as_read"]; ?></a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 250px;">
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex border-bottom align-items-start bg-light">
                                <div class="flex-shrink-0">
                                    <img src="assets/images/users/avatar-3.jpg"
                                    class="me-3 rounded-circle avatar-sm" alt="user-pic">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1"><?php echo $language["Justin_Verduzco"]; ?></h6>
                                    <div class="text-muted">
                                        <p class="mb-1 font-size-13"><?php echo $language["Your_task_changed_an_issue_from_In_Progress_to"]; ?><span class="badge text-success  bg-success-subtle"><?php echo $language["Review"]; ?></span></p>
                                        <p class="mb-0 font-size-10 text-uppercase fw-bold"><i class="mdi mdi-clock-outline"></i> <?php echo $language["1_hours_ago"]; ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex border-bottom align-items-start">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm me-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="bx bx-shopping-bag"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1"><?php echo $language["New_order_has_been_placed"]; ?></h6>
                                    <div class="text-muted">
                                        <p class="mb-1 font-size-13"><?php echo $language["Open_the_order_confirmation_or_shipment_confirmation"]; ?>.</p>
                                        <p class="mb-0 font-size-10 text-uppercase fw-bold"><i class="mdi mdi-clock-outline"></i> <?php echo $language["5_hours_ago"]; ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex border-bottom align-items-start">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm me-3">
                                        <span class="avatar-title bg-success-subtle text-success rounded-circle font-size-16">
                                            <i class="bx bx-cart"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1"><?php echo $language["Your_item_is_shipped"]; ?></h6>
                                    <div class="text-muted">
                                        <p class="mb-1 font-size-13"><?php echo $language["Here_is_somthing_that_you_might_light_like_to_know"]; ?>.</p>
                                        <p class="mb-0 font-size-10 text-uppercase fw-bold"><i class="mdi mdi-clock-outline"></i> <?php echo $language["1_day_ago"]; ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="" class="text-reset notification-item">
                            <div class="d-flex border-bottom align-items-start">
                                <div class="flex-shrink-0">
                                    <img src="assets/images/users/avatar-4.jpg"
                                        class="me-3 rounded-circle avatar-sm" alt="user-pic">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1"><?php echo $language["Salena_Layfield"]; ?></h6>
                                    <div class="text-muted">
                                        <p class="mb-1 font-size-13"><?php echo $language["Yay_Everything_worked"]; ?>!</p>
                                        <p class="mb-0 font-size-10 text-uppercase fw-bold"><i class="mdi mdi-clock-outline"></i> <?php echo $language["3_days_ago"]; ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 btn-block text-decoration-underline fw-bold text-center" href="javascript:void(0)">
                            <span><?php echo $language["View_All"]; ?> <i class='bx bx-right-arrow-alt'></i></span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item light-dark" id="mode-setting-btn">
                    <i data-feather="moon" class="icon-sm layout-mode-dark "></i>
                    <i data-feather="sun" class="icon-sm layout-mode-light"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item user text-start d-flex align-items-center" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-1.jpg"
                    alt="Header Avatar">
                </button>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <a class="dropdown-item" href="contacts-profile.php"><i class='bx bx-user-circle text-muted font-size-18 align-middle me-1'></i> <span class="align-middle"><?php echo $language["My_Account"]; ?></span></a>
                    <a class="dropdown-item" href="apps-chat.php"><i class='bx bx-chat text-muted font-size-18 align-middle me-1'></i> <span class="align-middle"><?php echo $language["Chat"]; ?></span></a>
                    <a class="dropdown-item" href="pages-faqs.php"><i class='bx bx-buoy text-muted font-size-18 align-middle me-1'></i> <span class="align-middle"><?php echo $language["Support"]; ?></span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item d-flex align-items-center" href="#"><i class='bx bx-cog text-muted font-size-18 align-middle me-1'></i> <span class="align-middle me-3"><?php echo $language["Settings"]; ?></span><span class="badge badge-soft-success ms-auto">New</span></a>
                    <a class="dropdown-item" href="auth-lock-screen.php"><i class='bx bx-lock text-muted font-size-18 align-middle me-1'></i> <span class="align-middle"><?php echo $language["Lock_screen"]; ?></span></a>
                    <a class="dropdown-item" href="auth-logout.php"><i class='bx bx-log-out text-muted font-size-18 align-middle me-1'></i> <span class="align-middle"><?php echo $language["Logout"]; ?></span></a>
                </div>
            </div>
        </div>
    </div>
</header>
    
