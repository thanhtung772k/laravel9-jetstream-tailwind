@extends('layouts.main')
@section('breadcrumb')
    <div class="hidden sm:-my-px sm:ml-10 sm:flex">
        {{ Breadcrumbs::render('add_timesheet-create') }}
    </div>
@endsection
@section('content')
    <div class="nav__sub-header absolute w-full" style="background-color: #fffafa;">
        <!-- Page Heading -->
        <header class=" shadow pt-[120px]">
            <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8 flex justify-center m-auto">
                <div class="bg-white row relative w-[730px]">
                    <header class="h-[54px] border rounded-t w-full">
                        <label class="add_timesheet-title pt-[0.7rem] pl-6">@lang('client/lang.post_create')</label>
                    </header>
                    <div class="carb-body border rounded-b ">
                        <form action="{{route('insert_post')}}" method="POST" class="p-6" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <div class="add_timesheet-title">
                                    <label>@lang('client/lang.title') <span class="text-red-500">*</span></label>
                                    <div>
                                        <section>
                                            <div class="input-group date">
                                                <input class="form-control" id="title" name="title" value="">
                                            </div>
                                        </section>
                                    </div>
                                </div>
                                @error('timesheet_id')
                                <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <div class="pt-4 add_timesheet-title">
                                    <label>@lang('client/lang.slug')</label>
                                    <div>
                                        <section>
                                            <div class="input-group date">
                                                <input class="form-control" id="slug" name="slug" value="">
                                            </div>
                                        </section>
                                    </div>
                                </div>
                                @error('timesheet_id')
                                <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <script>

                            </script>
                            <div>
                                <div class="row pt-4 add_timesheet-title">
                                    <div class="col-6">
                                        <label class="">@lang('client/lang.category') <span
                                                    class="text-red-500">*</span></label>
                                        <div>
                                            <select class="form-control text-xs" name="category">
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 flex justify-between items-end">
                                        <div>
                                            <label class="switch">
                                                <input type="checkbox" id="togBtn" name="toggleBtn">
                                                <div class="slider"></div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <style>
                                .switch {
                                    position: relative;
                                    display: inline-block;
                                    width: 90px;
                                    height: 36px;
                                }

                                .switch input {
                                    display: none;
                                }

                                .slider {
                                    position: absolute;
                                    cursor: pointer;
                                    top: 0;
                                    left: 0;
                                    right: 0;
                                    bottom: 0;
                                    background-color: #ca2222;
                                    -webkit-transition: .4s;
                                    transition: .4s;
                                    border-radius: 6px;
                                }

                                .slider:before {
                                    position: absolute;
                                    content: "";
                                    height: 34px;
                                    width: 32px;
                                    top: 1px;
                                    left: 1px;
                                    right: 1px;
                                    bottom: 1px;
                                    background-color: white;
                                    transition: 0.4s;
                                    border-radius: 6px;
                                }

                                input:checked + .slider {
                                    background-color: #2ab934;
                                }

                                input:focus + .slider {
                                    box-shadow: 0 0 1px #2196F3;
                                }

                                input:checked + .slider:before {
                                    -webkit-transform: translateX(26px);
                                    -ms-transform: translateX(26px);
                                    transform: translateX(55px);
                                }

                                .slider:after {
                                    content: 'Draff';
                                    color: white;
                                    display: block;
                                    position: absolute;
                                    transform: translate(-10%, -50%);
                                    top: 50%;
                                    left: 50%;
                                    font-size: 10px;
                                    font-family: Verdana, sans-serif;
                                }

                                input:checked + .slider:after {
                                    content: 'Public';
                                    transform: translate(-90%, -50%);
                                }
                            </style>

                            <div>
                                <div class="row pt-4 add_timesheet-title">
                                    <div class="col-6">
                                        <label>@lang('client/lang.img')
                                            <span class="text-red-500">*</span></label>
                                        <div class="form-group">
                                            <input type="file" name="evidence_image"
                                                   class="file_upload1 form-control-file" id="fileImageEvidence">
                                            <span id="file_error"></span>
                                        </div>
                                        @error('evidence_image')
                                        <div class="text-red-500"></div>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label></label>
                                        <div>
                                            <div class="old_image">
                                                <img src="https://ecs.fabbi.io/img/no-image-available.d704bd89.jpg"
                                                     width="100" height="100">
                                            </div>
                                        </div>
                                        <div class="img-holder"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <div class="pt-4 add_timesheet-title">
                                    <label>@lang('client/lang.content') <span class="text-red-500">*</span></label>
                                    <div id="container" class=" w-full">
                                        <textarea class="form-control min-h-[200px]" id="editor" name="content"></textarea>
                                    </div>
                                    @error('reason')
                                    <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <style>
                                #container {
                                    max-width: 100%;
                                    margin: 20px auto;
                                }
                                .ck-editor__editable[role="textbox"] {
                                    /* editing area */
                                    min-height: 200px;
                                    max-width: 680px;
                                }
                                .ck-content .image {
                                    /* block images */
                                    max-width: 80%;
                                    margin: 20px auto;
                                }
                            </style>
                            <div>
                                <div class="pt-4 add_timesheet-title">
                                    <label>@lang('client/lang.about_author')</label>
                                    <div>
                                        <div class="form-control" name="author" rows="3">{{$author->author_info}}</div>
                                    </div>
                                    @error('reason')
                                    <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <div class="row pt-4">
                                    <div class="col-2">
                                    </div>
                                    <div class="col-5">
                                        <button type="submit"
                                                class="btn btn-primary cus-btn-style bg-[#c2f2ff] cus-with-btn">
                                            @lang('lang.save_info')
                                        </button>
                                    </div>
                                    <div class="col-5">
                                        <button type="submit" class="btn cus-btn-style bg-[##f8f9fa] cus-border-btn">
                                            @lang('lang.cancel')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </header>
        <main>
            <div>
                Copyright © 2022 Fabbi JSC. All rights reserved.
            </div>
        </main>
    </div>
    <script src="{{ asset('js/timesheet/post.js') }}"></script>
    <script src="{{ asset('js/timesheet/add-timesheet.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/super-build/ckeditor.js"></script>
    <script>
        // This sample still does not showcase all CKEditor 5 features (!)
        // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
        CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
            // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
            toolbar: {
                items: [
                    'exportPDF','exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            // Changing the language of the interface requires loading the language file using the <script> tag.
            // language: 'es',
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
            placeholder: 'Welcome to CKEditor 5!',
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
            fontSize: {
                options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                supportAllValues: true
            },
            // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
            // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
            htmlSupport: {
                allow: [
                    {
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }
                ]
            },
            // Be careful with enabling previews
            // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
            htmlEmbed: {
                showPreviews: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
            mention: {
                feeds: [
                    {
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }
                ]
            },
            // The "super-build" contains more premium features that require additional configuration, disable them below.
            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
            removePlugins: [
                // These two are commercial, but you can try them out without registering to a trial.
                // 'ExportPdf',
                // 'ExportWord',
                'CKBox',
                'CKFinder',
                'EasyImage',
                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                // Storing images as Base64 is usually a very bad idea.
                // Replace it on production website with other solutions:
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                // 'Base64UploadAdapter',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                // from a local file system (file://) - load this site via HTTP server if you enable MathType
                'MathType'
            ]
        });
    </script>


@stop
