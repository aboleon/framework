<?php

return array(

    'Select' => 'Избери',
    'Deselect_All' => 'Deselect All',
    'Select_All' => 'Select All',
    'Erase' => 'Изтрий',
    'Open' => 'Отваряне',
    'Confirm_del' => 'Сигурни ли сте, че искате да изтриете този файл?',
    'All' => 'Всичко',
    'Files' => 'Файла',
    'Images' => 'Изображения',
    'Archives' => 'Архиви',
    'Error_Upload' => 'Каченият файл надминава максимално разрешената големина.',
    'Error_extension' => 'Това файлово разширение не е позволено.',
    'Upload_file' => 'Качете файл',
    'Filters' => 'Папка',
    'Videos' => 'Видео',
    'Music' => 'Музика',
    'New_Folder' => 'Нова папка',
    'Folder_Created' => 'Папката е правилно създадена',
    'Existing_Folder' => 'Съществуваща папка',
    'Confirm_Folder_del' => 'Сигурни ли сте, че искате да изтриете папката и всичко =>  което се съдържа с нея?',
    'Return_Files_List' => 'Връщане към списъка с файлове',
    'Preview' => 'Преглед',
    'Download' => 'Свали',
    'Insert_Folder_Name' => 'Въведете име на папката:',
    'Root' => 'Основна',
    'Rename' => 'Преименуване',
    'Back' => 'Обратно',
    'View' => 'Изглед',
    'View_list' => 'Списък',
    'View_columns_list' => 'Колони',
    'View_boxes' => 'Кутии',
    'Toolbar' => 'Лента с инструменти',
    'Actions' => 'Действия',
    'Rename_existing_file' => 'Файлът вече съществува',
    'Rename_existing_folder' => 'Папката вече съществува',
    'Empty_name' => 'Името на файла е празно',
    'Text_filter' => 'текстов филтър',
    'Swipe_help' => 'Плъзнете името на файла/папката за опции',
    'Upload_base' => 'Базово качване',
    'Upload_base_help' => "Drag & Drop files(modern browsers) or click in upper button to Add the file(s) and click on Start upload. When the upload is complete, click the 'Return to files list' button.",
    'Upload_add_files' => 'Add file(s)',
    'Upload_start' => 'Start upload',
    'Upload_error_messages' =>array(
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk',
        8 => 'A PHP extension stopped the file upload',
        'post_max_size' => 'The uploaded file exceeds the post_max_size directive in php.ini',
        'max_file_size' => 'File is too big',
        'min_file_size' => 'File is too small',
        'accept_file_types' => 'Filetype not allowed',
        'max_number_of_files' => 'Maximum number of files exceeded',
        'max_width' => 'Image exceeds maximum width',
        'min_width' => 'Image requires a minimum width',
        'max_height' => 'Image exceeds maximum height',
        'min_height' => 'Image requires a minimum height',
        'abort' => 'File upload aborted',
        'image_resize' => 'Failed to resize image'
    ),
    'Upload_url' => 'From url',
    'Type_dir' => 'папка',
    'Type' => 'Тип',
    'Dimension' => 'Размер',
    'Size' => 'Големина',
    'Date' => 'Дата',
    'Filename' => 'Име',
    'Operations' => 'Операции',
    'Date_type' => 'y-m-d',
    'OK' => 'ОК',
    'Cancel' => 'Отказ',
    'Sorting' => 'сортиране',
    'Show_url' => 'покажи URL',
    'Extract' => 'разархивирай тук',
    'File_info' => 'информация за файл',
    'Edit_image' => 'редактирай изображение',
    'Duplicate' => 'Дубликат',
    'Folders' =>  'Папки',
    'Copy' => 'Копиране',
    'Cut' => 'Изрязване',
    'Paste' => 'Поставяне',
    'CB' =>  'CB', // clipboard
    'Paste_Here' => 'Постави в тази папка',
    'Paste_Confirm' => 'Сигурни ли сте, че искате да поставите в тази папка? Това може да презапише файловете в нея.',
    'Paste_Failed' => 'Грешка при поставянето на файла/овете',
    'Clear_Clipboard' => 'Изчисти клипборда',
    'Clear_Clipboard_Confirm' => 'Сигурни ли сте, че искате да изчистите клипборда?',
    'Files_ON_Clipboard' => 'Има файлове в клипборда.',
    'Copy_Cut_Size_Limit' => 'Избраните файлове/папки са прекалено големи за %s. Лимит: %d MB/действие', // %s = cut or copy
    'Copy_Cut_Count_Limit' => 'Избрали сте прекаленено много файлове/папки за %s. Лимит: %d файла/действие', // %s = cut or copy
    'Copy_Cut_Not_Allowed' => 'Нямате право за %s на файлове.', // %s(1) = cut or copy =>  %s(2) = files or folders
    'Image_Editor_No_Save' =>  'Изображението не може да бъде записано',
    'Image_Editor_Exit' => "Exit",
    'Image_Editor_Save' => "Save",
    'Zip_No_Extract' =>  'Невъзможно разархивиране. Файлът вероятно е повреден.',
    'Zip_Invalid' =>  'Това разширене не се поддържа. Валидни: zip, gz, tar.',
    'Dir_No_Write' =>  'Нямате права за запис в избраната папка.',
    'Function_Disabled' =>  '%s-то е забранено на сървъра.', // %s = cut or copy
    'File_Permission' =>  'Файлови права',
    'File_Permission_Not_Allowed' =>  'Не е разрешена промяната на права за %s.', // %s = files or folders
    'File_Permission_Recursive' =>  'Рекурсивно прилагане?',
    'File_Permission_Wrong_Mode' =>  "Зададените права са грешни.",
    'User' =>  'Потребител',
    'Group' =>  'Група',
    'Yes' =>  'Да',
    'No' =>  'Не',
    'Lang_Not_Found' =>  'Езикът не може да бъде намерен.',
    'Lang_Change' =>  'Смени езика',
    'File_Not_Found' =>  'Файлът не може да бъде намерен.',
    'File_Open_Edit_Not_Allowed' =>  'Нямате разрешение за %s на този файл.', // %s = open or edit
    'Edit' =>  'Редакция',
    'Edit_File' =>  "Редакция на съдържанието на файла",
    'File_Save_OK' =>  "Файлът е успешно записан.",
    'File_Save_Error' =>  "Възникна грешка при записването на файла.",
    'New_File' => 'Нов файл',
    'No_Extension' => 'Трябва да зададете разширение на файла.',
    'Valid_Extensions' => 'Валидни разширения: %s', // %s = txt => log etc.
    'Upload_message' => "Провлачете и спуснете файла тук за да го качите.",

    'SERVER ERROR' => "СЪРВЪРНА ГРЕШКА",
    'forbidden' => "Забранено",
    'wrong path' => "Грешен път",
    'wrong name' => "Грешно име",
    'wrong extension' => "Грешно разширение",
    'wrong option' => "Грешна опция",
    'wrong data' => "Грешни данни",
    'wrong action' => "Грешно действие",
    'wrong sub-action' => "Грешно вторично действие",
    'no action passed' => "Не е подадено действие",
    'no path' => "Няма път",
    'no file' => "Няма файл",
    'view type number missing' => "Номерът на прегледа липсва",
    'Not enough Memory' => "Недостатъчна памет",
    'max_size_reached' => "Вашата папка за изображения достигна максимумът от %d MB.", //%d = max overall size
    'B' => "B",
    'KB' => "KB",
    'MB' => "MB",
    'GB' => "GB",
    'TB' => "TB",
    'total size' => "Общ размер",
);
