<!-- IMG FILES UPLOAD -->
<div class="fileupload-container hidden" id="aboleon-file-upload">
    <div id="fileupload">
        <div class="hidden messages">
            <span class="maxNumberOfFiles"><?=trans('core::ui.maxNumberOfFiles');?></span>
            <span class="max_elements"><?=trans('core::ui.max_elements');?></span>
            <span class="dimensions"><?=trans('core::ui.img_dimensions_constraint');?></span>
        </div>

        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar clearfix">
            <div>
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success btn-sm fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span><?=trans('aboleon.framework::forms.buttons.select_image');?></span>
                <input type="file" name="files[]" multiple>
            </span>

                <button type="submit" class="btn btn-info btn-sm start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span><?=trans('aboleon.framework::forms.buttons.download');?></span>
                </button>
                <button type="reset" class="btn btn-warning btn-sm cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span><?=trans('aboleon.framework::forms.buttons.cancel');?></span>
                </button>
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="mt-3 table table-striped d-none">
            <tbody class="files"></tbody>
        </table>
        <!-- The template to display files available for upload -->
        <script id="template-upload" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-upload">
            <td>
                <table style="width:100%"><tr>
                    <td class="impImg">
                        <span class="preview"></span>
                    </td>
                    <td class="impFileName">
                        <p class="name">{%=file.name%}</p>
                        <strong class="error text-danger"></strong>
                    </td>
                    <td>
                        <p class="size">Processing...</p>
                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
                    </td>
                    <td class="title"></td>
                    <td class="text-center">
                        {% if (!i && !o.options.autoUpload) { %}
                        <button class="btn btn-info btn-xs start" disabled>
                            {{ trans('aboleon.framework::ui.buttons.download') }}
                        </button>
                        {% } %}
                        {% if (!i) { %}
                        <button class="btn btn-danger btn-xs cancel">
                            {{ trans('aboleon.framework::ui.buttons.cancel') }}
                        </button>
                        {% } %}
                    </td></tr>
                    @foreach($locales as $locale)
                <tr class="description">
                    <td>Description {{ trans('aboleon.framework::lang.'.$locale.'.label') }}</td>
                        <td colspan="4"><textarea name="description[{{ $locale }}]" type="text" class="form-control description"></textarea></td>
                    </tr>
                    @endforeach
            </table></td>
        </tr>
        {% } %}



        </script>
        <!-- The template to display files available for download -->
        <script id="template-download" type="text/x-tmpl">
            {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-download fade">
                <td>
                    <span class="preview">
                        {% if (file.thumbnailUrl) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                        {% } %}
                    </span>
                </td>
                <td>
                    <p class="name">
                        {% if (file.url) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                        {% } else { %}
                        <span>{%=file.name%}</span>
                        {% } %}
                    </p>
                    {% if (file.error) { %}
                    <div><span class="label label-danger"><?=trans('aboleon.framework::forms.buttons.error');?></span> {%=file.error%}</div>
                    {% } %}
                </td>
                <td>
                    <span class="size">{%=o.formatFileSize(file.size)%}</span>
                </td>
                <td>
                    {% if (file.deleteUrl) { %}
                    <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                        <i class="glyphicon glyphicon-trash"></i>
                        <span><?=trans('aboleon.framework::forms.buttons.cancel');?></span>
                    </button>
                    <input type="checkbox" name="delete" value="1" class="toggle">
                    {% } else { %}
                    <button class="btn btn-warning cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span><?=trans('aboleon.framework::forms.buttons.cancel');?></span>
                    </button>
                    {% } %}
                </td>
            </tr>
            {% } %}



        </script>
    </div>
</div>
