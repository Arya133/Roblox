<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Web based File Manager in PHP, Manage your files efficiently and easily with Tiny File Manager">
    <meta name="author" content="KOMINFO @2023">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex">
        <title>DATA CENTER INDONESIA</title>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin/><link rel="dns-prefetch" href="https://cdn.jsdelivr.net"/>    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin/><link rel="dns-prefetch" href="https://cdnjs.cloudflare.com"/>    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">        <script type="text/javascript">window.csrf = '5d0dd6c222324ab80faacfd51a3ad85a141d357a2e2618b18297969f13d79387';</script>
    <style>
        html { -moz-osx-font-smoothing: grayscale; -webkit-font-smoothing: antialiased; text-rendering: optimizeLegibility; height: 100%; scroll-behavior: smooth;}
        *,*::before,*::after { box-sizing: border-box;}
        body { font-size:15px; color:#222;background:#F7F7F7; }
        body.navbar-fixed { margin-top:55px; }
        a, a:hover, a:visited, a:focus { text-decoration:none !important; }
        .filename, td, th { white-space:nowrap  }
        .navbar-brand { font-weight:bold; }
        .nav-item.avatar a { cursor:pointer;text-transform:capitalize; }
        .nav-item.avatar a > i { font-size:15px; }
        .nav-item.avatar .dropdown-menu a { font-size:13px; }
        #search-addon { font-size:12px;border-right-width:0; }
        .brl-0 { background:transparent;border-left:0; border-top-left-radius: 0; border-bottom-left-radius: 0; }
        .brr-0 { border-top-right-radius: 0; border-bottom-right-radius: 0; }
        .bread-crumb { color:#cccccc;font-style:normal; }
        #main-table { transition: transform .25s cubic-bezier(0.4, 0.5, 0, 1),width 0s .25s;}
        #main-table .filename a { color:#222222; }
        .table td, .table th { vertical-align:middle !important; }
        .table .custom-checkbox-td .custom-control.custom-checkbox, .table .custom-checkbox-header .custom-control.custom-checkbox { min-width:18px; display: flex;align-items: center; justify-content: center; }
        .table-sm td, .table-sm th { padding:.4rem; }
        .table-bordered td, .table-bordered th { border:1px solid #f1f1f1; }
        .hidden { display:none  }
        pre.with-hljs { padding:0; overflow: hidden;  }
        pre.with-hljs code { margin:0;border:0;overflow:scroll;  }
        code.maxheight, pre.maxheight { max-height:512px  }
        .fa.fa-caret-right { font-size:1.2em;margin:0 4px;vertical-align:middle;color:#ececec  }
        .fa.fa-home { font-size:1.3em;vertical-align:bottom  }
        .path { margin-bottom:10px  }
        form.dropzone { min-height:200px;border:2px dashed #007bff;line-height:6rem; }
        .right { text-align:right  }
        .center, .close, .login-form, .preview-img-container { text-align:center  }
        .message { padding:4px 7px;border:1px solid #ddd;background-color:#fff  }
        .message.ok { border-color:blue;color:blue  }
        .message.error { border-color:red;color:red  }
        .message.alert { border-color:orange;color:orange  }
        .preview-img { max-width:100%;max-height:80vh;background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAACQkWg2AAAAKklEQVR42mL5//8/Azbw+PFjrOJMDCSCUQ3EABZc4S0rKzsaSvTTABBgAMyfCMsY4B9iAAAAAElFTkSuQmCC);cursor:zoom-in }
        input#preview-img-zoomCheck[type=checkbox] { display:none }
        input#preview-img-zoomCheck[type=checkbox]:checked ~ label > img { max-width:none;max-height:none;cursor:zoom-out }
        .inline-actions > a > i { font-size:1em;margin-left:5px;background:#3785c1;color:#fff;padding:3px 4px;border-radius:3px; }
        .preview-video { position:relative;max-width:100%;height:0;padding-bottom:62.5%;margin-bottom:10px  }
        .preview-video video { position:absolute;width:100%;height:100%;left:0;top:0;background:#000  }
        .compact-table { border:0;width:auto  }
        .compact-table td, .compact-table th { width:100px;border:0;text-align:center  }
        .compact-table tr:hover td { background-color:#fff  }
        .filename { max-width:420px;overflow:hidden;text-overflow:ellipsis  }
        .break-word { word-wrap:break-word;margin-left:30px  }
        .break-word.float-left a { color:#7d7d7d  }
        .break-word + .float-right { padding-right:30px;position:relative  }
        .break-word + .float-right > a { color:#7d7d7d;font-size:1.2em;margin-right:4px  }
        #editor { position:absolute;right:15px;top:100px;bottom:15px;left:15px  }
        @media (max-width:481px) {
            #editor { top:150px; }
        }
        #normal-editor { border-radius:3px;border-width:2px;padding:10px;outline:none; }
        .btn-2 { padding:4px 10px;font-size:small; }
        li.file:before,li.folder:before { font:normal normal normal 14px/1 FontAwesome;content:"\f016";margin-right:5px }
        li.folder:before { content:"\f114" }
        i.fa.fa-folder-o { color:#0157b3 }
        i.fa.fa-picture-o { color:#26b99a }
        i.fa.fa-file-archive-o { color:#da7d7d }
        .btn-2 i.fa.fa-file-archive-o { color:inherit }
        i.fa.fa-css3 { color:#f36fa0 }
        i.fa.fa-file-code-o { color:#007bff }
        i.fa.fa-code { color:#cc4b4c }
        i.fa.fa-file-text-o { color:#0096e6 }
        i.fa.fa-html5 { color:#d75e72 }
        i.fa.fa-file-excel-o { color:#09c55d }
        i.fa.fa-file-powerpoint-o { color:#f6712e }
        i.go-back { font-size:1.2em;color:#007bff; }
        .main-nav { padding:0.2rem 1rem;box-shadow:0 4px 5px 0 rgba(0, 0, 0, .14), 0 1px 10px 0 rgba(0, 0, 0, .12), 0 2px 4px -1px rgba(0, 0, 0, .2)  }
        .dataTables_filter { display:none; }
        table.dataTable thead .sorting { cursor:pointer;background-repeat:no-repeat;background-position:center right;background-image:url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAATCAQAAADYWf5HAAAAkElEQVQoz7XQMQ5AQBCF4dWQSJxC5wwax1Cq1e7BAdxD5SL+Tq/QCM1oNiJidwox0355mXnG/DrEtIQ6azioNZQxI0ykPhTQIwhCR+BmBYtlK7kLJYwWCcJA9M4qdrZrd8pPjZWPtOqdRQy320YSV17OatFC4euts6z39GYMKRPCTKY9UnPQ6P+GtMRfGtPnBCiqhAeJPmkqAAAAAElFTkSuQmCC'); }
        table.dataTable thead .sorting_asc { cursor:pointer;background-repeat:no-repeat;background-position:center right;background-image:url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAATCAYAAAByUDbMAAAAZ0lEQVQ4y2NgGLKgquEuFxBPAGI2ahhWCsS/gDibUoO0gPgxEP8H4ttArEyuQYxAPBdqEAxPBImTY5gjEL9DM+wTENuQahAvEO9DMwiGdwAxOymGJQLxTyD+jgWDxCMZRsEoGAVoAADeemwtPcZI2wAAAABJRU5ErkJggg=='); }
        table.dataTable thead .sorting_desc { cursor:pointer;background-repeat:no-repeat;background-position:center right;background-image:url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAATCAYAAAByUDbMAAAAZUlEQVQ4y2NgGAWjYBSggaqGu5FA/BOIv2PBIPFEUgxjB+IdQPwfC94HxLykus4GiD+hGfQOiB3J8SojEE9EM2wuSJzcsFMG4ttQgx4DsRalkZENxL+AuJQaMcsGxBOAmGvopk8AVz1sLZgg0bsAAAAASUVORK5CYII='); }
        table.dataTable thead tr:first-child th.custom-checkbox-header:first-child { background-image:none; }
        .footer-action li { margin-bottom:10px; }
        .app-v-title { font-size:24px;font-weight:300;letter-spacing:-.5px;text-transform:uppercase; }
        hr.custom-hr { border-top:1px dashed #8c8b8b;border-bottom:1px dashed #fff; }
        #snackbar { visibility:hidden;min-width:250px;margin-left:-125px;background-color:#333;color:#fff;text-align:center;border-radius:2px;padding:16px;position:fixed;z-index:1;left:50%;bottom:30px;font-size:17px; }
        #snackbar.show { visibility:visible;-webkit-animation:fadein 0.5s, fadeout 0.5s 2.5s;animation:fadein 0.5s, fadeout 0.5s 2.5s; }
        @-webkit-keyframes fadein { from { bottom:0;opacity:0; }
        to { bottom:30px;opacity:1; }
        }
        @keyframes fadein { from { bottom:0;opacity:0; }
        to { bottom:30px;opacity:1; }
        }
        @-webkit-keyframes fadeout { from { bottom:30px;opacity:1; }
        to { bottom:0;opacity:0; }
        }
        @keyframes fadeout { from { bottom:30px;opacity:1; }
        to { bottom:0;opacity:0; }
        }
        #main-table span.badge { border-bottom:2px solid #f8f9fa }
        #main-table span.badge:nth-child(1) { border-color:#df4227 }
        #main-table span.badge:nth-child(2) { border-color:#f8b600 }
        #main-table span.badge:nth-child(3) { border-color:#00bd60 }
        #main-table span.badge:nth-child(4) { border-color:#4581ff }
        #main-table span.badge:nth-child(5) { border-color:#ac68fc }
        #main-table span.badge:nth-child(6) { border-color:#45c3d2 }
        @media only screen and (min-device-width:768px) and (max-device-width:1024px) and (orientation:landscape) and (-webkit-min-device-pixel-ratio:2) { .navbar-collapse .col-xs-6 { padding:0; }
        }
        .btn.active.focus,.btn.active:focus,.btn.focus,.btn.focus:active,.btn:active:focus,.btn:focus { outline:0!important;outline-offset:0!important;background-image:none!important;-webkit-box-shadow:none!important;box-shadow:none!important }
        .lds-facebook { display:none;position:relative;width:64px;height:64px }
        .lds-facebook div,.lds-facebook.show-me { display:inline-block }
        .lds-facebook div { position:absolute;left:6px;width:13px;background:#007bff;animation:lds-facebook 1.2s cubic-bezier(0,.5,.5,1) infinite }
        .lds-facebook div:nth-child(1) { left:6px;animation-delay:-.24s }
        .lds-facebook div:nth-child(2) { left:26px;animation-delay:-.12s }
        .lds-facebook div:nth-child(3) { left:45px;animation-delay:0s }
        @keyframes lds-facebook { 0% { top:6px;height:51px }
        100%,50% { top:19px;height:26px }
        }
        ul#search-wrapper { padding-left: 0;border: 1px solid #ecececcc; } ul#search-wrapper li { list-style: none; padding: 5px;border-bottom: 1px solid #ecececcc; }
        ul#search-wrapper li:nth-child(odd){ background: #f9f9f9cc;}
        .c-preview-img { max-width: 300px; }
        .border-radius-0 { border-radius: 0; }
        .float-right { float: right; }
        .table-hover>tbody>tr:hover>td:first-child { border-left: 1px solid #1b77fd; }
        #main-table tr.even { background-color: #F8F9Fa; }
        .filename>a>i {margin-right: 3px;}
    </style>
            <style>
            :root {
                --bs-bg-opacity: 1;
                --bg-color: #f3daa6;
                --bs-dark-rgb: 28, 36, 41 !important;
                --bs-bg-opacity: 1;
            }
            .table-dark { --bs-table-bg: 28, 36, 41 !important; }
            .btn-primary { --bs-btn-bg: #26566c; --bs-btn-border-color: #26566c; }
            body.theme-dark { background-image: linear-gradient(90deg, #1c2429, #263238); color: #CFD8DC; }
            .list-group .list-group-item { background: #343a40; }
            .theme-dark .navbar-nav i, .navbar-nav .dropdown-toggle, .break-word { color: #CFD8DC; }
            a, a:hover, a:visited, a:active, #main-table .filename a, i.fa.fa-folder-o, i.go-back { color: var(--bg-color); }
            ul#search-wrapper li:nth-child(odd) { background: #212a2f; }
            .theme-dark .btn-outline-primary { color: #b8e59c; border-color: #b8e59c; }
            .theme-dark .btn-outline-primary:hover, .theme-dark .btn-outline-primary:active { background-color: #2d4121;}
            .theme-dark input.form-control { background-color: #101518; color: #CFD8DC; }
            .theme-dark .dropzone { background: transparent; }
            .theme-dark .inline-actions > a > i { background: #79755e; }
            .theme-dark .text-white { color: #CFD8DC !important; }
            .theme-dark .table-bordered td, .table-bordered th { border-color: #343434; }
            .theme-dark .table-bordered td .custom-control-input, .theme-dark .table-bordered th .custom-control-input { opacity: 0.678; }
            .message { background-color: #212529; }
            .compact-table tr:hover td { background-color: #3d3d3d; }
            #main-table tr.even { background-color: #21292f; }
            form.dropzone { border-color: #79755e; }
        </style>
    </head>
<body class="theme-dark navbar-fixed">
<div id="wrapper" class="container-fluid">
    <!-- New Item creation -->
    <div class="modal fade" id="createNewItem" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="newItemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content text-white bg-dark" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="newItemModalLabel"><i class="fa fa-plus-square fa-fw"></i>Create New Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><label for="newfile">Item Type </label></p>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="newfile" id="customRadioInline1" name="newfile" value="file">
                      <label class="form-check-label" for="customRadioInline1">File</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="newfile" id="customRadioInline2" value="folder" checked>
                      <label class="form-check-label" for="customRadioInline2">Folder</label>
                    </div>

                    <p class="mt-3"><label for="newfilename">Item Name </label></p>
                    <input type="text" name="newfilename" id="newfilename" value="" class="form-control" placeholder="Enter here..." required>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="token" value="5d0dd6c222324ab80faacfd51a3ad85a141d357a2e2618b18297969f13d79387">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Create Now</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Advance Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content text-white bg-dark">
          <div class="modal-header">
            <h5 class="modal-title col-10" id="searchModalLabel">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Search a files" aria-label="Search" aria-describedby="search-addon3" id="advanced-search" autofocus required>
                  <span class="input-group-text" id="search-addon3"><i class="fa fa-search"></i></span>
                </div>
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" method="post">
                <div class="lds-facebook"><div></div><div></div><div></div></div>
                <ul id="search-wrapper">
                    <p class="m-2">Search file in folder and subfolders...</p>
                </ul>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!--Rename Modal -->
    <div class="modal modal-alert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" id="renameDailog">
      <div class="modal-dialog" role="document">
        <form class="modal-content rounded-3 shadow text-white bg-dark" method="post" autocomplete="off">
          <div class="modal-body p-4 text-center">
            <h5 class="mb-3">Are you sure want to rename?</h5>
            <p class="mb-1">
                <input type="text" name="rename_to" id="js-rename-to" class="form-control" placeholder="Enter new file name" required>
                <input type="hidden" name="token" value="5d0dd6c222324ab80faacfd51a3ad85a141d357a2e2618b18297969f13d79387">
                <input type="hidden" name="rename_from" id="js-rename-from">
            </p>
          </div>
          <div class="modal-footer flex-nowrap p-0">
            <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-end" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0"><strong>Okay</strong></button>
          </div>
        </form>
      </div>
    </div>

    <!-- Confirm Modal -->
    <script type="text/html" id="js-tpl-confirm">
        <div class="modal modal-alert confirmDailog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" id="confirmDailog-<%this.id%>">
          <div class="modal-dialog" role="document">
            <form class="modal-content rounded-3 shadow text-white bg-dark" method="post" autocomplete="off" action="<%this.action%>">
              <div class="modal-body p-4 text-center">
                <h5 class="mb-2">Are you sure want to <%this.title%> ?</h5>
                <p class="mb-1"><%this.content%></p>
              </div>
              <div class="modal-footer flex-nowrap p-0">
                <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-end" data-bs-dismiss="modal">Cancel</button>
                <input type="hidden" name="token" value="5d0dd6c222324ab80faacfd51a3ad85a141d357a2e2618b18297969f13d79387">
                <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0" data-bs-dismiss="modal"><strong>Okay</strong></button>
              </div>
            </form>
          </div>
        </div>
    </script>

        <nav class="navbar navbar-expand-lg text-white bg-dark navbar-light navbar-dark mb-4 main-nav fixed-top">
        <a class="navbar-brand"> File Manager </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <div class="col-xs-6 col-sm-5"><a href='?p='><i class='fa fa-home' aria-hidden='true' title='/home/perpdiak/public_html'></i></a></div>
            <div class="col-xs-6 col-sm-7">
                <ul class="navbar-nav justify-content-end text-white bg-dark">
                    <li class="nav-item mr-2">
                        <div class="input-group input-group-sm mr-1" style="margin-top:4px;">
                            <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search-addon2" id="search-addon">
                            <div class="input-group-append">
                                <span class="input-group-text brl-0 brr-0" id="search-addon2"><i class="fa fa-search"></i></span>
                            </div>
                            <div class="input-group-append btn-group">
                                <span class="input-group-text dropdown-toggle brl-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                                  <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="." id="js-search-modal" data-bs-toggle="modal" data-bs-target="#searchModal">Advanced Search</a>
                                  </div>
                            </div>
                        </div>
                    </li>
                                        <li class="nav-item">
                        <a title="Upload" class="nav-link" href="?p=&amp;upload"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Upload</a>
                    </li>
                    <li class="nav-item">
                        <a title="New Item" class="nav-link" href="#createNewItem" data-bs-toggle="modal" data-bs-target="#createNewItem"><i class="fa fa-plus-square"></i> New Item</a>
                    </li>
                                                            <li class="nav-item avatar dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-5" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-user-circle"></i> kominfo</a>
                        <div class="dropdown-menu text-small shadow text-white bg-dark" aria-labelledby="navbarDropdownMenuLink-5">
                                                        <a title="Settings" class="dropdown-item nav-link" href="?p=&amp;settings=1"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a>
                                                        <a title="Help" class="dropdown-item nav-link" href="?p=&amp;help=2"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Help</a>
                            <a title="Sign Out" class="dropdown-item nav-link" href="?logout=1"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign Out</a>
                        </div>
                    </li>
                                    </ul>
            </div>
        </div>
    </nav>
    <form action="" method="post" class="pt-3">
    <input type="hidden" name="p" value="">
    <input type="hidden" name="group" value="1">
    <input type="hidden" name="token" value="5d0dd6c222324ab80faacfd51a3ad85a141d357a2e2618b18297969f13d79387">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm text-white bg-dark table-dark" id="main-table">
            <thead class="thead-white">
            <tr>
                                    <th style="width:3%" class="custom-checkbox-header">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="js-select-all-items" onclick="checkbox_toggle()">
                            <label class="custom-control-label" for="js-select-all-items"></label>
                        </div>
                    </th>                <th>Name</th>
                <th>Size</th>
                <th>Modified</th>
                                    <th>Perms</th>
                    <th>Owner</th>                <th>Actions</th>
            </tr>
            </thead>
                            <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="3399" name="file[]" value="00 template">
                            <label class="custom-control-label" for="3399"></label>
                        </div>
                        </td>                    <td data-sort=00 template>
                        <div class="filename"><a href="?p=00+template"><i class="fa fa-folder-o"></i> 00 template                            </a></div>
                    </td>
                    <td data-order="a-000000000000000000">
                        Folder                    </td>
                    <td data-order="a-1572780365">11/03/2019 11:26 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=00+template">0755</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">                            <a title="Delete" href="?p=&amp;del=00+template" onclick="confirmDailog(event, '1028','Delete Folder','00+template', this.href);"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <a title="Rename" href="#" onclick="rename('', '00 template');return false;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a title="Copy to..." href="?p=&amp;copy=00+template"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/00 template/" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="3400" name="file[]" value="admin">
                            <label class="custom-control-label" for="3400"></label>
                        </div>
                        </td>                    <td data-sort=admin>
                        <div class="filename"><a href="?p=admin"><i class="fa fa-folder-o"></i> admin                            </a></div>
                    </td>
                    <td data-order="a-000000000000000000">
                        Folder                    </td>
                    <td data-order="a-1572780428">11/03/2019 11:27 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=admin">0755</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">                            <a title="Delete" href="?p=&amp;del=admin" onclick="confirmDailog(event, '1028','Delete Folder','admin', this.href);"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'admin');return false;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a title="Copy to..." href="?p=&amp;copy=admin"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/admin/" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="3401" name="file[]" value="ALFA_DATA">
                            <label class="custom-control-label" for="3401"></label>
                        </div>
                        </td>                    <td data-sort=ALFA_DATA>
                        <div class="filename"><a href="?p=ALFA_DATA"><i class="fa fa-folder-o"></i> ALFA_DATA                            </a></div>
                    </td>
                    <td data-order="a-000000000000000000">
                        Folder                    </td>
                    <td data-order="a-1739916261">02/18/2025 10:04 PM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=ALFA_DATA">0755</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">                            <a title="Delete" href="?p=&amp;del=ALFA_DATA" onclick="confirmDailog(event, '1028','Delete Folder','ALFA_DATA', this.href);"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'ALFA_DATA');return false;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a title="Copy to..." href="?p=&amp;copy=ALFA_DATA"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/ALFA_DATA/" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="3402" name="file[]" value="files">
                            <label class="custom-control-label" for="3402"></label>
                        </div>
                        </td>                    <td data-sort=files>
                        <div class="filename"><a href="?p=files"><i class="fa fa-folder-o"></i> files                            </a></div>
                    </td>
                    <td data-order="a-000000000000000000">
                        Folder                    </td>
                    <td data-order="a-1605785839">11/19/2020 11:37 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=files">0755</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">                            <a title="Delete" href="?p=&amp;del=files" onclick="confirmDailog(event, '1028','Delete Folder','files', this.href);"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'files');return false;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a title="Copy to..." href="?p=&amp;copy=files"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/files/" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="3403" name="file[]" value="images">
                            <label class="custom-control-label" for="3403"></label>
                        </div>
                        </td>                    <td data-sort=images>
                        <div class="filename"><a href="?p=images"><i class="fa fa-folder-o"></i> images                            </a></div>
                    </td>
                    <td data-order="a-000000000000000000">
                        Folder                    </td>
                    <td data-order="a-1572783862">11/03/2019 12:24 PM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=images">0755</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">                            <a title="Delete" href="?p=&amp;del=images" onclick="confirmDailog(event, '1028','Delete Folder','images', this.href);"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'images');return false;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a title="Copy to..." href="?p=&amp;copy=images"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/images/" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="3404" name="file[]" value="install">
                            <label class="custom-control-label" for="3404"></label>
                        </div>
                        </td>                    <td data-sort=install>
                        <div class="filename"><a href="?p=install"><i class="fa fa-folder-o"></i> install                            </a></div>
                    </td>
                    <td data-order="a-000000000000000000">
                        Folder                    </td>
                    <td data-order="a-1572783897">11/03/2019 12:24 PM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=install">0755</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">                            <a title="Delete" href="?p=&amp;del=install" onclick="confirmDailog(event, '1028','Delete Folder','install', this.href);"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'install');return false;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a title="Copy to..." href="?p=&amp;copy=install"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/install/" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="3405" name="file[]" value="js">
                            <label class="custom-control-label" for="3405"></label>
                        </div>
                        </td>                    <td data-sort=js>
                        <div class="filename"><a href="?p=js"><i class="fa fa-folder-o"></i> js                            </a></div>
                    </td>
                    <td data-order="a-000000000000000000">
                        Folder                    </td>
                    <td data-order="a-1572783982">11/03/2019 12:26 PM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=js">0755</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">                            <a title="Delete" href="?p=&amp;del=js" onclick="confirmDailog(event, '1028','Delete Folder','js', this.href);"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'js');return false;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a title="Copy to..." href="?p=&amp;copy=js"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/js/" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="3406" name="file[]" value="lib">
                            <label class="custom-control-label" for="3406"></label>
                        </div>
                        </td>                    <td data-sort=lib>
                        <div class="filename"><a href="?p=lib"><i class="fa fa-folder-o"></i> lib                            </a></div>
                    </td>
                    <td data-order="a-000000000000000000">
                        Folder                    </td>
                    <td data-order="a-1572784235">11/03/2019 12:30 PM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=lib">0755</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">                            <a title="Delete" href="?p=&amp;del=lib" onclick="confirmDailog(event, '1028','Delete Folder','lib', this.href);"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'lib');return false;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a title="Copy to..." href="?p=&amp;copy=lib"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/lib/" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="3407" name="file[]" value="m">
                            <label class="custom-control-label" for="3407"></label>
                        </div>
                        </td>                    <td data-sort=m>
                        <div class="filename"><a href="?p=m"><i class="fa fa-folder-o"></i> m                            </a></div>
                    </td>
                    <td data-order="a-000000000000000000">
                        Folder                    </td>
                    <td data-order="a-1572784252">11/03/2019 12:30 PM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=m">0755</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">                            <a title="Delete" href="?p=&amp;del=m" onclick="confirmDailog(event, '1028','Delete Folder','m', this.href);"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'm');return false;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a title="Copy to..." href="?p=&amp;copy=m"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/m/" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="3408" name="file[]" value="repository">
                            <label class="custom-control-label" for="3408"></label>
                        </div>
                        </td>                    <td data-sort=repository>
                        <div class="filename"><a href="?p=repository"><i class="fa fa-folder-o"></i> repository                            </a></div>
                    </td>
                    <td data-order="a-000000000000000000">
                        Folder                    </td>
                    <td data-order="a-1739554802">02/14/2025 5:40 PM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=repository">0755</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">                            <a title="Delete" href="?p=&amp;del=repository" onclick="confirmDailog(event, '1028','Delete Folder','repository', this.href);"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'repository');return false;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a title="Copy to..." href="?p=&amp;copy=repository"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/repository/" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="3409" name="file[]" value="sample">
                            <label class="custom-control-label" for="3409"></label>
                        </div>
                        </td>                    <td data-sort=sample>
                        <div class="filename"><a href="?p=sample"><i class="fa fa-folder-o"></i> sample                            </a></div>
                    </td>
                    <td data-order="a-000000000000000000">
                        Folder                    </td>
                    <td data-order="a-1572784253">11/03/2019 12:30 PM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=sample">0755</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">                            <a title="Delete" href="?p=&amp;del=sample" onclick="confirmDailog(event, '1028','Delete Folder','sample', this.href);"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'sample');return false;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a title="Copy to..." href="?p=&amp;copy=sample"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/sample/" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="3410" name="file[]" value="simbio2">
                            <label class="custom-control-label" for="3410"></label>
                        </div>
                        </td>                    <td data-sort=simbio2>
                        <div class="filename"><a href="?p=simbio2"><i class="fa fa-folder-o"></i> simbio2                            </a></div>
                    </td>
                    <td data-order="a-000000000000000000">
                        Folder                    </td>
                    <td data-order="a-1572784260">11/03/2019 12:31 PM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=simbio2">0755</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">                            <a title="Delete" href="?p=&amp;del=simbio2" onclick="confirmDailog(event, '1028','Delete Folder','simbio2', this.href);"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'simbio2');return false;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a title="Copy to..." href="?p=&amp;copy=simbio2"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/simbio2/" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="3411" name="file[]" value="template">
                            <label class="custom-control-label" for="3411"></label>
                        </div>
                        </td>                    <td data-sort=template>
                        <div class="filename"><a href="?p=template"><i class="fa fa-folder-o"></i> template                            </a></div>
                    </td>
                    <td data-order="a-000000000000000000">
                        Folder                    </td>
                    <td data-order="a-1572788331">11/03/2019 1:38 PM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=template">0755</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">                            <a title="Delete" href="?p=&amp;del=template" onclick="confirmDailog(event, '1028','Delete Folder','template', this.href);"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'template');return false;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a title="Copy to..." href="?p=&amp;copy=template"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/template/" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="3412" name="file[]" value="upgrade">
                            <label class="custom-control-label" for="3412"></label>
                        </div>
                        </td>                    <td data-sort=upgrade>
                        <div class="filename"><a href="?p=upgrade"><i class="fa fa-folder-o"></i> upgrade                            </a></div>
                    </td>
                    <td data-order="a-000000000000000000">
                        Folder                    </td>
                    <td data-order="a-1572788332">11/03/2019 1:38 PM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=upgrade">0755</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">                            <a title="Delete" href="?p=&amp;del=upgrade" onclick="confirmDailog(event, '1028','Delete Folder','upgrade', this.href);"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'upgrade');return false;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a title="Copy to..." href="?p=&amp;copy=upgrade"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/upgrade/" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="3413" name="file[]" value="zero">
                            <label class="custom-control-label" for="3413"></label>
                        </div>
                        </td>                    <td data-sort=zero>
                        <div class="filename"><a href="?p=zero"><i class="fa fa-folder-o"></i> zero                            </a></div>
                    </td>
                    <td data-order="a-000000000000000000">
                        Folder                    </td>
                    <td data-order="a-1739557028">02/14/2025 6:17 PM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=zero">0755</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">                            <a title="Delete" href="?p=&amp;del=zero" onclick="confirmDailog(event, '1028','Delete Folder','zero', this.href);"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'zero');return false;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a title="Copy to..." href="?p=&amp;copy=zero"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/zero/" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6070" name="file[]" value=".gitignore">
                            <label class="custom-control-label" for="6070"></label>
                        </div>
                        </td>                    <td data-sort=.gitignore>
                        <div class="filename">
                                                        <a href="?p=&amp;view=.gitignore" title=".gitignore">
                                                                <i class="fa fa-file-code-o"></i> .gitignore                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000000254"><span title="254 bytes">
                        254 B                        </span></td>
                    <td data-order="b-1384999436">11/21/2013 2:03 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=.gitignore">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=.gitignore" onclick="confirmDailog(event, 1209, 'Delete File','.gitignore', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', '.gitignore');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=.gitignore"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/.gitignore" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=.gitignore" onclick="confirmDailog(event, 1211, 'Download','.gitignore', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6071" name="file[]" value=".htaccess">
                            <label class="custom-control-label" for="6071"></label>
                        </div>
                        </td>                    <td data-sort=.htaccess>
                        <div class="filename">
                                                        <a href="?p=&amp;view=.htaccess" title=".htaccess">
                                                                <i class="fa fa-file-text-o"></i> .htaccess                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000000637"><span title="637 bytes">
                        637 B                        </span></td>
                    <td data-order="b-1581416322">02/11/2020 10:18 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=.htaccess">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=.htaccess" onclick="confirmDailog(event, 1209, 'Delete File','.htaccess', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', '.htaccess');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=.htaccess"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/.htaccess" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=.htaccess" onclick="confirmDailog(event, 1211, 'Download','.htaccess', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6072" name="file[]" value="0x.txt">
                            <label class="custom-control-label" for="6072"></label>
                        </div>
                        </td>                    <td data-sort=0x.txt>
                        <div class="filename">
                                                        <a href="?p=&amp;view=0x.txt" title="0x.txt">
                                                                <i class="fa fa-file-text-o"></i> 0x.txt                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000000146"><span title="146 bytes">
                        146 B                        </span></td>
                    <td data-order="b-1638680779">12/05/2021 5:06 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=0x.txt">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=0x.txt" onclick="confirmDailog(event, 1209, 'Delete File','0x.txt', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', '0x.txt');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=0x.txt"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/0x.txt" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=0x.txt" onclick="confirmDailog(event, 1211, 'Download','0x.txt', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6073" name="file[]" value="2017-10-12.jpg">
                            <label class="custom-control-label" for="6073"></label>
                        </div>
                        </td>                    <td data-sort=2017-10-12.jpg>
                        <div class="filename">
                                                        <a href="?p=&amp;view=2017-10-12.jpg" data-preview-image="http://perpustakaan.stdhkbp.ac.id/2017-10-12.jpg" title="2017-10-12.jpg">
                                                               <i class="fa fa-picture-o"></i> 2017-10-12.jpg                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000020096"><span title="20096 bytes">
                        19.63 KB                        </span></td>
                    <td data-order="b-1517392906">01/31/2018 10:01 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=2017-10-12.jpg">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=2017-10-12.jpg" onclick="confirmDailog(event, 1209, 'Delete File','2017-10-12.jpg', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', '2017-10-12.jpg');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=2017-10-12.jpg"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/2017-10-12.jpg" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=2017-10-12.jpg" onclick="confirmDailog(event, 1211, 'Download','2017-10-12.jpg', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6074" name="file[]" value="adam.txt">
                            <label class="custom-control-label" for="6074"></label>
                        </div>
                        </td>                    <td data-sort=adam.txt>
                        <div class="filename">
                                                        <a href="?p=&amp;view=adam.txt" title="adam.txt">
                                                                <i class="fa fa-file-text-o"></i> adam.txt                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000000053"><span title="53 bytes">
                        53 B                        </span></td>
                    <td data-order="b-1634663317">10/19/2021 5:08 PM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=adam.txt">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=adam.txt" onclick="confirmDailog(event, 1209, 'Delete File','adam.txt', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'adam.txt');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=adam.txt"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/adam.txt" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=adam.txt" onclick="confirmDailog(event, 1211, 'Download','adam.txt', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6075" name="file[]" value="admin.txt">
                            <label class="custom-control-label" for="6075"></label>
                        </div>
                        </td>                    <td data-sort=admin.txt>
                        <div class="filename">
                                                        <a href="?p=&amp;view=admin.txt" title="admin.txt">
                                                                <i class="fa fa-file-text-o"></i> admin.txt                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000001753"><span title="1753 bytes">
                        1.71 KB                        </span></td>
                    <td data-order="b-1651738463">05/05/2022 8:14 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=admin.txt">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=admin.txt" onclick="confirmDailog(event, 1209, 'Delete File','admin.txt', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'admin.txt');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=admin.txt"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/admin.txt" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=admin.txt" onclick="confirmDailog(event, 1211, 'Download','admin.txt', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6076" name="file[]" value="alfabusuk.php">
                            <label class="custom-control-label" for="6076"></label>
                        </div>
                        </td>                    <td data-sort=alfabusuk.php>
                        <div class="filename">
                                                        <a href="?p=&amp;view=alfabusuk.php" title="alfabusuk.php">
                                                                <i class="fa fa-code"></i> alfabusuk.php                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000457259"><span title="457259 bytes">
                        446.54 KB                        </span></td>
                    <td data-order="b-1702445338">12/13/2023 5:28 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=alfabusuk.php">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=alfabusuk.php" onclick="confirmDailog(event, 1209, 'Delete File','alfabusuk.php', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'alfabusuk.php');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=alfabusuk.php"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/alfabusuk.php" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=alfabusuk.php" onclick="confirmDailog(event, 1211, 'Download','alfabusuk.php', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6077" name="file[]" value="changes.txt">
                            <label class="custom-control-label" for="6077"></label>
                        </div>
                        </td>                    <td data-sort=changes.txt>
                        <div class="filename">
                                                        <a href="?p=&amp;view=changes.txt" title="changes.txt">
                                                                <i class="fa fa-file-text-o"></i> changes.txt                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000015739"><span title="15739 bytes">
                        15.37 KB                        </span></td>
                    <td data-order="b-1384999436">11/21/2013 2:03 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=changes.txt">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=changes.txt" onclick="confirmDailog(event, 1209, 'Delete File','changes.txt', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'changes.txt');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=changes.txt"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/changes.txt" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=changes.txt" onclick="confirmDailog(event, 1211, 'Download','changes.txt', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6078" name="file[]" value="f.txt">
                            <label class="custom-control-label" for="6078"></label>
                        </div>
                        </td>                    <td data-sort=f.txt>
                        <div class="filename">
                                                        <a href="?p=&amp;view=f.txt" title="f.txt">
                                                                <i class="fa fa-file-text-o"></i> f.txt                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000000061"><span title="61 bytes">
                        61 B                        </span></td>
                    <td data-order="b-1643788792">02/02/2022 7:59 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=f.txt">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=f.txt" onclick="confirmDailog(event, 1209, 'Delete File','f.txt', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'f.txt');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=f.txt"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/f.txt" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=f.txt" onclick="confirmDailog(event, 1211, 'Download','f.txt', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6079" name="file[]" value="GPL-3.0 License.txt">
                            <label class="custom-control-label" for="6079"></label>
                        </div>
                        </td>                    <td data-sort=GPL-3.0 License.txt>
                        <div class="filename">
                                                        <a href="?p=&amp;view=GPL-3.0+License.txt" title="GPL-3.0 License.txt">
                                                                <i class="fa fa-file-text-o"></i> GPL-3.0 License.txt                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000035821"><span title="35821 bytes">
                        34.98 KB                        </span></td>
                    <td data-order="b-1384999436">11/21/2013 2:03 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=GPL-3.0+License.txt">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=GPL-3.0+License.txt" onclick="confirmDailog(event, 1209, 'Delete File','GPL-3.0+License.txt', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'GPL-3.0 License.txt');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=GPL-3.0+License.txt"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/GPL-3.0 License.txt" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=GPL-3.0+License.txt" onclick="confirmDailog(event, 1211, 'Download','GPL-3.0+License.txt', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6080" name="file[]" value="hacker.txt">
                            <label class="custom-control-label" for="6080"></label>
                        </div>
                        </td>                    <td data-sort=hacker.txt>
                        <div class="filename">
                                                        <a href="?p=&amp;view=hacker.txt" title="hacker.txt">
                                                                <i class="fa fa-file-text-o"></i> hacker.txt                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000001249"><span title="1249 bytes">
                        1.22 KB                        </span></td>
                    <td data-order="b-1654450707">06/05/2022 5:38 PM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=hacker.txt">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=hacker.txt" onclick="confirmDailog(event, 1209, 'Delete File','hacker.txt', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'hacker.txt');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=hacker.txt"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/hacker.txt" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=hacker.txt" onclick="confirmDailog(event, 1211, 'Download','hacker.txt', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6081" name="file[]" value="hekeers.txt">
                            <label class="custom-control-label" for="6081"></label>
                        </div>
                        </td>                    <td data-sort=hekeers.txt>
                        <div class="filename">
                                                        <a href="?p=&amp;view=hekeers.txt" title="hekeers.txt">
                                                                <i class="fa fa-file-text-o"></i> hekeers.txt                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000000017"><span title="17 bytes">
                        17 B                        </span></td>
                    <td data-order="b-1739358477">02/12/2025 11:07 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=hekeers.txt">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=hekeers.txt" onclick="confirmDailog(event, 1209, 'Delete File','hekeers.txt', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'hekeers.txt');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=hekeers.txt"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/hekeers.txt" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=hekeers.txt" onclick="confirmDailog(event, 1211, 'Download','hekeers.txt', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6082" name="file[]" value="index.php">
                            <label class="custom-control-label" for="6082"></label>
                        </div>
                        </td>                    <td data-sort=index.php>
                        <div class="filename">
                                                        <a href="?p=&amp;view=index.php" title="index.php">
                                                                <i class="fa fa-code"></i> index.php                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000004165"><span title="4165 bytes">
                        4.07 KB                        </span></td>
                    <td data-order="b-1581416345">02/11/2020 10:19 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=index.php">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=index.php" onclick="confirmDailog(event, 1209, 'Delete File','index.php', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'index.php');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=index.php"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/index.php" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=index.php" onclick="confirmDailog(event, 1211, 'Download','index.php', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6083" name="file[]" value="index.txt">
                            <label class="custom-control-label" for="6083"></label>
                        </div>
                        </td>                    <td data-sort=index.txt>
                        <div class="filename">
                                                        <a href="?p=&amp;view=index.txt" title="index.txt">
                                                                <i class="fa fa-file-text-o"></i> index.txt                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000000316"><span title="316 bytes">
                        316 B                        </span></td>
                    <td data-order="b-1674138316">01/19/2023 2:25 PM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=index.txt">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=index.txt" onclick="confirmDailog(event, 1209, 'Delete File','index.txt', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'index.txt');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=index.txt"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/index.txt" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=index.txt" onclick="confirmDailog(event, 1211, 'Download','index.txt', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6084" name="file[]" value="lah.txt">
                            <label class="custom-control-label" for="6084"></label>
                        </div>
                        </td>                    <td data-sort=lah.txt>
                        <div class="filename">
                                                        <a href="?p=&amp;view=lah.txt" title="lah.txt">
                                                                <i class="fa fa-file-text-o"></i> lah.txt                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000000345"><span title="345 bytes">
                        345 B                        </span></td>
                    <td data-order="b-1605178607">11/12/2020 10:56 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=lah.txt">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=lah.txt" onclick="confirmDailog(event, 1209, 'Delete File','lah.txt', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'lah.txt');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=lah.txt"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/lah.txt" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=lah.txt" onclick="confirmDailog(event, 1211, 'Download','lah.txt', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6085" name="file[]" value="life.txt">
                            <label class="custom-control-label" for="6085"></label>
                        </div>
                        </td>                    <td data-sort=life.txt>
                        <div class="filename">
                                                        <a href="?p=&amp;view=life.txt" title="life.txt">
                                                                <i class="fa fa-file-text-o"></i> life.txt                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000000033"><span title="33 bytes">
                        33 B                        </span></td>
                    <td data-order="b-1643028029">01/24/2022 12:40 PM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=life.txt">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=life.txt" onclick="confirmDailog(event, 1209, 'Delete File','life.txt', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'life.txt');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=life.txt"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/life.txt" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=life.txt" onclick="confirmDailog(event, 1211, 'Download','life.txt', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6086" name="file[]" value="logo.jpg">
                            <label class="custom-control-label" for="6086"></label>
                        </div>
                        </td>                    <td data-sort=logo.jpg>
                        <div class="filename">
                                                        <a href="?p=&amp;view=logo.jpg" data-preview-image="http://perpustakaan.stdhkbp.ac.id/logo.jpg" title="logo.jpg">
                                                               <i class="fa fa-picture-o"></i> logo.jpg                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000023102"><span title="23102 bytes">
                        22.56 KB                        </span></td>
                    <td data-order="b-1517393294">01/31/2018 10:08 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=logo.jpg">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=logo.jpg" onclick="confirmDailog(event, 1209, 'Delete File','logo.jpg', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'logo.jpg');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=logo.jpg"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/logo.jpg" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=logo.jpg" onclick="confirmDailog(event, 1211, 'Download','logo.jpg', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6087" name="file[]" value="logo.png">
                            <label class="custom-control-label" for="6087"></label>
                        </div>
                        </td>                    <td data-sort=logo.png>
                        <div class="filename">
                                                        <a href="?p=&amp;view=logo.png" data-preview-image="http://perpustakaan.stdhkbp.ac.id/logo.png" title="logo.png">
                                                               <i class="fa fa-picture-o"></i> logo.png                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000223815"><span title="223815 bytes">
                        218.57 KB                        </span></td>
                    <td data-order="b-1517393310">01/31/2018 10:08 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=logo.png">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=logo.png" onclick="confirmDailog(event, 1209, 'Delete File','logo.png', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'logo.png');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=logo.png"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/logo.png" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=logo.png" onclick="confirmDailog(event, 1211, 'Download','logo.png', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6088" name="file[]" value="m.txt">
                            <label class="custom-control-label" for="6088"></label>
                        </div>
                        </td>                    <td data-sort=m.txt>
                        <div class="filename">
                                                        <a href="?p=&amp;view=m.txt" title="m.txt">
                                                                <i class="fa fa-file-text-o"></i> m.txt                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000000272"><span title="272 bytes">
                        272 B                        </span></td>
                    <td data-order="b-1648985254">04/03/2022 11:27 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=m.txt">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=m.txt" onclick="confirmDailog(event, 1209, 'Delete File','m.txt', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'm.txt');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=m.txt"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/m.txt" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=m.txt" onclick="confirmDailog(event, 1211, 'Download','m.txt', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6089" name="file[]" value="oai.php">
                            <label class="custom-control-label" for="6089"></label>
                        </div>
                        </td>                    <td data-sort=oai.php>
                        <div class="filename">
                                                        <a href="?p=&amp;view=oai.php" title="oai.php">
                                                                <i class="fa fa-code"></i> oai.php                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000004726"><span title="4726 bytes">
                        4.62 KB                        </span></td>
                    <td data-order="b-1384999436">11/21/2013 2:03 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=oai.php">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=oai.php" onclick="confirmDailog(event, 1209, 'Delete File','oai.php', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'oai.php');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=oai.php"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/oai.php" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=oai.php" onclick="confirmDailog(event, 1211, 'Download','oai.php', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6090" name="file[]" value="php.ini">
                            <label class="custom-control-label" for="6090"></label>
                        </div>
                        </td>                    <td data-sort=php.ini>
                        <div class="filename">
                                                        <a href="?p=&amp;view=php.ini" title="php.ini">
                                                                <i class="fa fa-file-text-o"></i> php.ini                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000000231"><span title="231 bytes">
                        231 B                        </span></td>
                    <td data-order="b-1572858013">11/04/2019 9:00 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=php.ini">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=php.ini" onclick="confirmDailog(event, 1209, 'Delete File','php.ini', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'php.ini');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=php.ini"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/php.ini" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=php.ini" onclick="confirmDailog(event, 1211, 'Download','php.ini', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6091" name="file[]" value="README">
                            <label class="custom-control-label" for="6091"></label>
                        </div>
                        </td>                    <td data-sort=README>
                        <div class="filename">
                                                        <a href="?p=&amp;view=README" title="README">
                                                                <i class="fa fa-info-circle"></i> README                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000000440"><span title="440 bytes">
                        440 B                        </span></td>
                    <td data-order="b-1384999436">11/21/2013 2:03 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=README">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=README" onclick="confirmDailog(event, 1209, 'Delete File','README', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'README');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=README"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/README" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=README" onclick="confirmDailog(event, 1211, 'Download','README', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6092" name="file[]" value="readme.txt">
                            <label class="custom-control-label" for="6092"></label>
                        </div>
                        </td>                    <td data-sort=readme.txt>
                        <div class="filename">
                                                        <a href="?p=&amp;view=readme.txt" title="readme.txt">
                                                                <i class="fa fa-file-text-o"></i> readme.txt                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000000066"><span title="66 bytes">
                        66 B                        </span></td>
                    <td data-order="b-1654808352">06/09/2022 8:59 PM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=readme.txt">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=readme.txt" onclick="confirmDailog(event, 1209, 'Delete File','readme.txt', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'readme.txt');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=readme.txt"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/readme.txt" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=readme.txt" onclick="confirmDailog(event, 1211, 'Download','readme.txt', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6093" name="file[]" value="robots.txt">
                            <label class="custom-control-label" for="6093"></label>
                        </div>
                        </td>                    <td data-sort=robots.txt>
                        <div class="filename">
                                                        <a href="?p=&amp;view=robots.txt" title="robots.txt">
                                                                <i class="fa fa-file-text-o"></i> robots.txt                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000000022"><span title="22 bytes">
                        22 B                        </span></td>
                    <td data-order="b-1654808323">06/09/2022 8:58 PM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=robots.txt">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=robots.txt" onclick="confirmDailog(event, 1209, 'Delete File','robots.txt', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'robots.txt');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=robots.txt"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/robots.txt" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=robots.txt" onclick="confirmDailog(event, 1211, 'Download','robots.txt', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6094" name="file[]" value="sg.txt">
                            <label class="custom-control-label" for="6094"></label>
                        </div>
                        </td>                    <td data-sort=sg.txt>
                        <div class="filename">
                                                        <a href="?p=&amp;view=sg.txt" title="sg.txt">
                                                                <i class="fa fa-file-text-o"></i> sg.txt                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000000044"><span title="44 bytes">
                        44 B                        </span></td>
                    <td data-order="b-1704295791">01/03/2024 3:29 PM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=sg.txt">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=sg.txt" onclick="confirmDailog(event, 1209, 'Delete File','sg.txt', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'sg.txt');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=sg.txt"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/sg.txt" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=sg.txt" onclick="confirmDailog(event, 1211, 'Download','sg.txt', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6095" name="file[]" value="supports.txt">
                            <label class="custom-control-label" for="6095"></label>
                        </div>
                        </td>                    <td data-sort=supports.txt>
                        <div class="filename">
                                                        <a href="?p=&amp;view=supports.txt" title="supports.txt">
                                                                <i class="fa fa-file-text-o"></i> supports.txt                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000000277"><span title="277 bytes">
                        277 B                        </span></td>
                    <td data-order="b-1384999436">11/21/2013 2:03 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=supports.txt">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=supports.txt" onclick="confirmDailog(event, 1209, 'Delete File','supports.txt', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'supports.txt');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=supports.txt"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/supports.txt" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=supports.txt" onclick="confirmDailog(event, 1211, 'Download','supports.txt', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6096" name="file[]" value="sysconfig.inc.php">
                            <label class="custom-control-label" for="6096"></label>
                        </div>
                        </td>                    <td data-sort=sysconfig.inc.php>
                        <div class="filename">
                                                        <a href="?p=&amp;view=sysconfig.inc.php" title="sysconfig.inc.php">
                                                                <i class="fa fa-code"></i> sysconfig.inc.php                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000026205"><span title="26205 bytes">
                        25.59 KB                        </span></td>
                    <td data-order="b-1581415494">02/11/2020 10:04 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=sysconfig.inc.php">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=sysconfig.inc.php" onclick="confirmDailog(event, 1209, 'Delete File','sysconfig.inc.php', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'sysconfig.inc.php');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=sysconfig.inc.php"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/sysconfig.inc.php" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=sysconfig.inc.php" onclick="confirmDailog(event, 1211, 'Download','sysconfig.inc.php', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6097" name="file[]" value="sysconfig.local.inc.php">
                            <label class="custom-control-label" for="6097"></label>
                        </div>
                        </td>                    <td data-sort=sysconfig.local.inc.php>
                        <div class="filename">
                                                        <a href="?p=&amp;view=sysconfig.local.inc.php" title="sysconfig.local.inc.php">
                                                                <i class="fa fa-code"></i> sysconfig.local.inc.php                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000001988"><span title="1988 bytes">
                        1.94 KB                        </span></td>
                    <td data-order="b-1581416577">02/11/2020 10:22 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=sysconfig.local.inc.php">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=sysconfig.local.inc.php" onclick="confirmDailog(event, 1209, 'Delete File','sysconfig.local.inc.php', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'sysconfig.local.inc.php');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=sysconfig.local.inc.php"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/sysconfig.local.inc.php" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=sysconfig.local.inc.php" onclick="confirmDailog(event, 1211, 'Download','sysconfig.local.inc.php', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6098" name="file[]" value="ucnode.inc.php">
                            <label class="custom-control-label" for="6098"></label>
                        </div>
                        </td>                    <td data-sort=ucnode.inc.php>
                        <div class="filename">
                                                        <a href="?p=&amp;view=ucnode.inc.php" title="ucnode.inc.php">
                                                                <i class="fa fa-code"></i> ucnode.inc.php                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000001434"><span title="1434 bytes">
                        1.4 KB                        </span></td>
                    <td data-order="b-1573027687">11/06/2019 8:08 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=ucnode.inc.php">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=ucnode.inc.php" onclick="confirmDailog(event, 1209, 'Delete File','ucnode.inc.php', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'ucnode.inc.php');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=ucnode.inc.php"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/ucnode.inc.php" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=ucnode.inc.php" onclick="confirmDailog(event, 1211, 'Download','ucnode.inc.php', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6099" name="file[]" value="uu.txt">
                            <label class="custom-control-label" for="6099"></label>
                        </div>
                        </td>                    <td data-sort=uu.txt>
                        <div class="filename">
                                                        <a href="?p=&amp;view=uu.txt" title="uu.txt">
                                                                <i class="fa fa-file-text-o"></i> uu.txt                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000000284"><span title="284 bytes">
                        284 B                        </span></td>
                    <td data-order="b-1606922249">12/02/2020 3:17 PM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=uu.txt">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=uu.txt" onclick="confirmDailog(event, 1209, 'Delete File','uu.txt', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'uu.txt');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=uu.txt"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/uu.txt" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=uu.txt" onclick="confirmDailog(event, 1211, 'Download','uu.txt', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6100" name="file[]" value="webicon.ico">
                            <label class="custom-control-label" for="6100"></label>
                        </div>
                        </td>                    <td data-sort=webicon.ico>
                        <div class="filename">
                                                        <a href="?p=&amp;view=webicon.ico" data-preview-image="http://perpustakaan.stdhkbp.ac.id/webicon.ico" title="webicon.ico">
                                                               <i class="fa fa-picture-o"></i> webicon.ico                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000008062"><span title="8062 bytes">
                        7.87 KB                        </span></td>
                    <td data-order="b-1384999436">11/21/2013 2:03 AM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=webicon.ico">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=webicon.ico" onclick="confirmDailog(event, 1209, 'Delete File','webicon.ico', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'webicon.ico');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=webicon.ico"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/webicon.ico" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=webicon.ico" onclick="confirmDailog(event, 1211, 'Download','webicon.ico', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tr>
                                            <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6101" name="file[]" value="zlzal.txt">
                            <label class="custom-control-label" for="6101"></label>
                        </div>
                        </td>                    <td data-sort=zlzal.txt>
                        <div class="filename">
                                                        <a href="?p=&amp;view=zlzal.txt" title="zlzal.txt">
                                                                <i class="fa fa-file-text-o"></i> zlzal.txt                                </a>
                                                        </div>
                    </td>
                    <td data-order="b-000000000000000143"><span title="143 bytes">
                        143 B                        </span></td>
                    <td data-order="b-1643028149">01/24/2022 12:42 PM</td>
                                            <td><a title="Change Permissions" href="?p=&amp;chmod=zlzal.txt">0644</a>                        </td>
                        <td>perpdiak:perpdiak</td>
                                        <td class="inline-actions">
                                                    <a title="Delete" href="?p=&amp;del=zlzal.txt" onclick="confirmDailog(event, 1209, 'Delete File','zlzal.txt', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="Rename" href="#" onclick="rename('', 'zlzal.txt');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="Copy to..."
                               href="?p=&amp;copy=zlzal.txt"><i class="fa fa-files-o"></i></a>
                                                <a title="Direct link" href="http://perpustakaan.stdhkbp.ac.id/zlzal.txt" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="Download" href="?p=&amp;dl=zlzal.txt" onclick="confirmDailog(event, 1211, 'Download','zlzal.txt', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                                <tfoot>
                    <tr>
                        <td class="gray" colspan="7">
                            Full Size: <span class="badge text-bg-light border-radius-0">809.62 KB</span>                            File: <span class="badge text-bg-light border-radius-0">32</span>                            Folder: <span class="badge text-bg-light border-radius-0">15</span>                        </td>
                    </tr>
                </tfoot>
                        </table>
    </div>

    <div class="row">
                <div class="col-xs-12 col-sm-9">
            <ul class="list-inline footer-action">
                <li class="list-inline-item"> <a href="#/select-all" class="btn btn-small btn-outline-primary btn-2" onclick="select_all();return false;"><i class="fa fa-check-square"></i> Select all </a></li>
                <li class="list-inline-item"><a href="#/unselect-all" class="btn btn-small btn-outline-primary btn-2" onclick="unselect_all();return false;"><i class="fa fa-window-close"></i> Unselect all </a></li>
                <li class="list-inline-item"><a href="#/invert-all" class="btn btn-small btn-outline-primary btn-2" onclick="invert_all();return false;"><i class="fa fa-th-list"></i> Invert Selection </a></li>
                <li class="list-inline-item"><input type="submit" class="hidden" name="delete" id="a-delete" value="Delete" onclick="return confirm('Delete selected files and folders?')">
                    <a href="javascript:document.getElementById('a-delete').click();" class="btn btn-small btn-outline-primary btn-2"><i class="fa fa-trash"></i> Delete </a></li>
                <li class="list-inline-item"><input type="submit" class="hidden" name="zip" id="a-zip" value="zip" onclick="return confirm('Create archive?')">
                    <a href="javascript:document.getElementById('a-zip').click();" class="btn btn-small btn-outline-primary btn-2"><i class="fa fa-file-archive-o"></i> Zip </a></li>
                <li class="list-inline-item"><input type="submit" class="hidden" name="tar" id="a-tar" value="tar" onclick="return confirm('Create archive?')">
                    <a href="javascript:document.getElementById('a-tar').click();" class="btn btn-small btn-outline-primary btn-2"><i class="fa fa-file-archive-o"></i> Tar </a></li>
                <li class="list-inline-item"><input type="submit" class="hidden" name="copy" id="a-copy" value="Copy">
                    <a href="javascript:document.getElementById('a-copy').click();" class="btn btn-small btn-outline-primary btn-2"><i class="fa fa-files-o"></i> Copy </a></li>
            </ul>
        </div>
        <div class="col-3 d-none d-sm-block"><a href="https://tinyfilemanager.github.io" target="_blank" class="float-right text-muted">Tiny File Manager 2.5.3</a></div>
            </div>
</form>

</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script><script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" crossorigin="anonymous" defer></script><script>
    function template(html,options){
        var re=/<\%([^\%>]+)?\%>/g,reExp=/(^( )?(if|for|else|switch|case|break|{|}))(.*)?/g,code='var r=[];\n',cursor=0,match;var add=function(line,js){js?(code+=line.match(reExp)?line+'\n':'r.push('+line+');\n'):(code+=line!=''?'r.push("'+line.replace(/"/g,'\\"')+'");\n':'');return add}
        while(match=re.exec(html)){add(html.slice(cursor,match.index))(match[1],!0);cursor=match.index+match[0].length}
        add(html.substr(cursor,html.length-cursor));code+='return r.join("");';return new Function(code.replace(/[\r\t\n]/g,'')).apply(options)
    }
    function rename(e, t) { if(t) { $("#js-rename-from").val(t);$("#js-rename-to").val(t); $("#renameDailog").modal('show'); } }
    function change_checkboxes(e, t) { for (var n = e.length - 1; n >= 0; n--) e[n].checked = "boolean" == typeof t ? t : !e[n].checked }
    function get_checkboxes() { for (var e = document.getElementsByName("file[]"), t = [], n = e.length - 1; n >= 0; n--) (e[n].type = "checkbox") && t.push(e[n]); return t }
    function select_all() { change_checkboxes(get_checkboxes(), !0) }
    function unselect_all() { change_checkboxes(get_checkboxes(), !1) }
    function invert_all() { change_checkboxes(get_checkboxes()) }
    function checkbox_toggle() { var e = get_checkboxes(); e.push(this), change_checkboxes(e) }
    function backup(e, t) { // Create file backup with .bck
        var n = new XMLHttpRequest,
            a = "path=" + e + "&file=" + t + "&token="+ window.csrf +"&type=backup&ajax=true";
        return n.open("POST", "", !0), n.setRequestHeader("Content-type", "application/x-www-form-urlencoded"), n.onreadystatechange = function () {
            4 == n.readyState && 200 == n.status && toast(n.responseText)
        }, n.send(a), !1
    }
    // Toast message
    function toast(txt) { var x = document.getElementById("snackbar");x.innerHTML=txt;x.className = "show";setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000); }
    // Save file
    function edit_save(e, t) {
        var n = "ace" == t ? editor.getSession().getValue() : document.getElementById("normal-editor").value;
        if (typeof n !== 'undefined' && n !== null) {
            if (true) {
                var data = {ajax: true, content: n, type: 'save', token: window.csrf};$.ajax({
                    type: "POST",
                    url: window.location,
                    data: JSON.stringify(data),
                    contentType: "application/json; charset=utf-8",
                    success: function(mes){toast("Saved Successfully"); window.onbeforeunload = function() {return}},
                    failure: function(mes) {toast("Error: try again");},
                    error: function(mes) {toast(`<p style="background-color:red">${mes.responseText}</p>`);}
                });
            } else {
                var a = document.createElement("form");
                a.setAttribute("method", "POST"), a.setAttribute("action", "");
                var o = document.createElement("textarea");
                o.setAttribute("type", "textarea"), o.setAttribute("name", "savedata");
                let cx = document.createElement("input"); cx.setAttribute("type", "hidden");cx.setAttribute("name", "token");cx.setAttribute("value", window.csrf);
                var c = document.createTextNode(n);
                o.appendChild(c), a.appendChild(o), a.appendChild(cx), document.body.appendChild(a), a.submit()
            }
        }
    }
    function show_new_pwd() { $(".js-new-pwd").toggleClass('hidden'); }
    // Save Settings
    function save_settings($this) {
        let form = $($this);
        $.ajax({
            type: form.attr('method'), url: form.attr('action'), data: form.serialize()+"&token="+ window.csrf +"&ajax="+true,
            success: function (data) {if(data) { window.location.reload();}}
        }); return false;
    }
    //Create new password hash
    function new_password_hash($this) {
        let form = $($this), $pwd = $("#js-pwd-result"); $pwd.val('');
        $.ajax({
            type: form.attr('method'), url: form.attr('action'), data: form.serialize()+"&token="+ window.csrf +"&ajax="+true,
            success: function (data) { if(data) { $pwd.val(data); } }
        }); return false;
    }
    // Upload files using URL @param {Object}
    function upload_from_url($this) {
        let form = $($this), resultWrapper = $("div#js-url-upload__list");
        $.ajax({
            type: form.attr('method'), url: form.attr('action'), data: form.serialize()+"&token="+ window.csrf +"&ajax="+true,
            beforeSend: function() { form.find("input[name=uploadurl]").attr("disabled","disabled"); form.find("button").hide(); form.find(".lds-facebook").addClass('show-me'); },
            success: function (data) {
                if(data) {
                    data = JSON.parse(data);
                    if(data.done) {
                        resultWrapper.append('<div class="alert alert-success row">Uploaded Successful: '+data.done.name+'</div>'); form.find("input[name=uploadurl]").val('');
                    } else if(data['fail']) { resultWrapper.append('<div class="alert alert-danger row">Error: '+data.fail.message+'</div>'); }
                    form.find("input[name=uploadurl]").removeAttr("disabled");form.find("button").show();form.find(".lds-facebook").removeClass('show-me');
                }
            },
            error: function(xhr) {
                form.find("input[name=uploadurl]").removeAttr("disabled");form.find("button").show();form.find(".lds-facebook").removeClass('show-me');console.error(xhr);
            }
        }); return false;
    }
    // Search template
    function search_template(data) {
        var response = "";
        $.each(data, function (key, val) {
            response += `<li><a href="?p=${val.path}&view=${val.name}">${val.path}/${val.name}</a></li>`;
        });
        return response;
    }
    // Advance search
    function fm_search() {
        var searchTxt = $("input#advanced-search").val(), searchWrapper = $("ul#search-wrapper"), path = $("#js-search-modal").attr("href"), _html = "", $loader = $("div.lds-facebook");
        if(!!searchTxt && searchTxt.length > 2 && path) {
            var data = {ajax: true, content: searchTxt, path:path, type: 'search', token: window.csrf };
            $.ajax({
                type: "POST",
                url: window.location,
                data: data,
                beforeSend: function() {
                    searchWrapper.html('');
                    $loader.addClass('show-me');
                },
                success: function(data){
                    $loader.removeClass('show-me');
                    data = JSON.parse(data);
                    if(data && data.length) {
                        _html = search_template(data);
                        searchWrapper.html(_html);
                    } else { searchWrapper.html('<p class="m-2">No result found!<p>'); }
                },
                error: function(xhr) { $loader.removeClass('show-me'); searchWrapper.html('<p class="m-2">ERROR: Try again later!</p>'); },
                failure: function(mes) { $loader.removeClass('show-me'); searchWrapper.html('<p class="m-2">ERROR: Try again later!</p>');}
            });
        } else { searchWrapper.html("OOPS: minimum 3 characters required!"); }
    }

    // action confirm dailog modal
    function confirmDailog(e, id = 0, title = "Action", content = "", action = null) {
        e.preventDefault();
        const tplObj = {id, title, content: decodeURIComponent(content.replace(/\+/g, ' ')), action};
        let tpl = $("#js-tpl-confirm").html();
        $(".modal.confirmDailog").remove();
        $('#wrapper').append(template(tpl,tplObj));
        const $confirmDailog = $("#confirmDailog-"+tplObj.id);
        $confirmDailog.modal('show');
        return false;
    }
    

    // on mouse hover image preview
    !function(s){s.previewImage=function(e){var o=s(document),t=".previewImage",a=s.extend({xOffset:20,yOffset:-20,fadeIn:"fast",css:{padding:"5px",border:"1px solid #cccccc","background-color":"#fff"},eventSelector:"[data-preview-image]",dataKey:"previewImage",overlayId:"preview-image-plugin-overlay"},e);return o.off(t),o.on("mouseover"+t,a.eventSelector,function(e){s("p#"+a.overlayId).remove();var o=s("<p>").attr("id",a.overlayId).css("position","absolute").css("display","none").append(s('<img class="c-preview-img">').attr("src",s(this).data(a.dataKey)));a.css&&o.css(a.css),s("body").append(o),o.css("top",e.pageY+a.yOffset+"px").css("left",e.pageX+a.xOffset+"px").fadeIn(a.fadeIn)}),o.on("mouseout"+t,a.eventSelector,function(){s("#"+a.overlayId).remove()}),o.on("mousemove"+t,a.eventSelector,function(e){s("#"+a.overlayId).css("top",e.pageY+a.yOffset+"px").css("left",e.pageX+a.xOffset+"px")}),this},s.previewImage()}(jQuery);

    // Dom Ready Events
    $(document).ready( function () {
        // dataTable init
        var $table = $('#main-table'),
            tableLng = $table.find('th').length,
            _targets = (tableLng && tableLng == 7 ) ? [0, 4,5,6] : tableLng == 5 ? [0,4] : [3];
            mainTable = $('#main-table').DataTable({paging: false, info: false, order: [], columnDefs: [{targets: _targets, orderable: false}]
        });
        // filter table
        $('#search-addon').on( 'keyup', function () {
            mainTable.search( this.value ).draw();
        });
        $("input#advanced-search").on('keyup', function (e) {
            if (e.keyCode === 13) { fm_search(); }
        });
        $('#search-addon3').on( 'click', function () { fm_search(); });
        //upload nav tabs
        $(".fm-upload-wrapper .card-header-tabs").on("click", 'a', function(e){
            e.preventDefault();let target=$(this).data('target');
            $(".fm-upload-wrapper .card-header-tabs a").removeClass('active');$(this).addClass('active');
            $(".fm-upload-wrapper .card-tabs-container").addClass('hidden');$(target).removeClass('hidden');
        });
    });
</script>
<div id="snackbar"></div>
</body>
</html>
