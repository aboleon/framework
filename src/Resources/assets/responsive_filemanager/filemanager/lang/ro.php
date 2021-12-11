<?php

return array(

    'Select' => 'Selectează',
    'Deselect_All' => 'Deselect All',
    'Select_All' => 'Select All',
    'Erase' => 'Șterge',
    'Open' => 'Deschide',
    'Confirm_del' => 'Sunteți sigur(ă) că vreți să ștergeți acest fișier?',
    'All' => 'Toate',
    'Files' => 'Fișiere',
    'Images' => 'Imagini',
    'Archives' => 'Arhive',
    'Error_Upload' => 'Fișierul încărcat depășește dimensiunea maximă admisă.',
    'Error_extension' => 'Fișierele cu această extensie nu sunt permise',
    'Upload_file' => 'Upload', // Încarcă - this is the correct translation for "Upload" but in Romania, we are more familiar to the english term
    'Filters' => 'Filtre',
    'Videos' => 'Fișiere video',
    'Music' => 'Fișiere audio',
    'New_Folder' => 'Folder nou',
    'Folder_Created' => 'Folderul a fost creat cu succes',
    'Existing_Folder' => 'Folder existent',
    'Confirm_Folder_del' => 'Sunteți sigur(ă) că vreți să ștergeți acest folder și toate fișierele din el?',
    'Return_Files_List' => 'Înapoi la lista de fișiere',
    'Preview' => 'Previzualizare',
    'Download' => 'Descărcare',
    'Insert_Folder_Name' => 'Adaugă denumire la folder:',
    'Root' => 'folder rădăcină',
    'Rename' => 'Redenumire',
    'Back' => 'înapoi',
    'View' => 'Vizualizare',
    'View_list' => 'Vizualizare listă',
    'View_columns_list' => 'Vizualizare coloane',
    'View_boxes' => 'Vizualizare pictograme',
    'Toolbar' => 'Bară de unelte',
    'Actions' => 'Acțiuni',
    'Rename_existing_file' => 'Deja există un fișier cu această denumire',
    'Rename_existing_folder' => 'Deja există un folder cu această denumire',
    'Empty_name' => 'Denumirea nu este completată',
    'Text_filter' => 'filtru text',
    'Swipe_help' => 'Glisează pe numele fișierului/folderului pentru opțiuni',
    'Upload_base' => 'Upload standard',
    'Upload_base_help' => "Adaugă fișiere (drag & drop - browsere moderne) sau click pe butonul Adaugă fișier(e), de mai sus apoi pe butonul Start upload. După ce upload-ul este finalizat, apăsați pe butonul Înapoi la lista de fișiere.",
    'Upload_add_files' => 'Adaugă fișier(e)',
    'Upload_start' => 'Start upload',
    'Upload_error_messages' =>array(
        1 => 'Dimensiunea fișierului uploadat depășește valoarea din directiva upload_max_filesize din fișierul php.ini',
        2 => 'Dimensiunea fișierului uploadat depășește valoarea din directiva MAX_FILE_SIZE specificată în formularul HTML',
        3 => 'Fișierul uploadat a fost încărcat parțial ',
        4 => 'Nicun fișier nu a fost uploadat',
        6 => 'Folderul temporar lipsește',
        7 => 'Scrierea fișierului pe disc a eșuat',
        8 => 'O extensie PHP a întrerupt upload-ul',
        'post_max_size' => 'Dimensiunea fișierului uploadat depășește valoarea din directiva post_max_size din fișierul php.ini',
        'max_file_size' => 'Fișierul este prea mare',
        'min_file_size' => 'Fișierul este prea mic',
        'accept_file_types' => 'Tipul de fișier nu este permis',
        'max_number_of_files' => 'Numărul maxim de fișiere a fost depășit',
        'max_width' => 'Rezoluția imaginii depășește lățimea maximă admisă',
        'min_width' => 'Rezoluția imaginii este mai mică decât lățimea minimă necesară',
        'max_height' => 'Rezoluția imaginii depășește înălțimea maximă admisă',
        'min_height' => 'Rezoluția imaginii este mai mică decât înălțimea minimă necesară',
        'abort' => 'Procesul de upload a fost întrerupt',
        'image_resize' => 'Imaginea nu a putut fi redimensionată'
    ),
    'Upload_url' => 'Din url',
    'Type_dir' => 'dir',
    'Type' => 'Tip',
    'Dimension' => 'Dimensiune',
    'Size' => 'Mărime',
    'Date' => 'Data',
    'Filename' => 'Nume fișier',
    'Operations' => 'Operații',
    'Date_type' => 'y-m-d',
    'OK' => 'OK',
    'Cancel' => 'Anulare',
    'Sorting' => 'sortare',
    'Show_url' => 'Afisează URL',
    'Extract' => 'Extrage aici',
    'File_info' => 'informații fișier',
    'Edit_image' => 'Editare imagine',
    'Duplicate' => 'Multiplicare',
    'Folders' => 'Foldere',
    'Copy' => 'Copiere',
    'Cut' => 'Tăiere',
    'Paste' => 'Lipire',
    'CB' => 'Clipboard', // clipboard
    'Paste_Here' => 'Lipire în acest folder',
    'Paste_Confirm' => 'Sunteți sigur(ă) că doriți să copiați fișierul în acest folder? Această operațiune va suprascrie folderele sau fișierele cu aceiași denumire.',
    'Paste_Failed' => 'Operațiunea de lipire a fișierelor a eșuat',
    'Clear_Clipboard' => 'Șterge clipboard',
    'Clear_Clipboard_Confirm' => 'Sunteți sigur(ă) că doriți să ștergeți conținutul clipboard-ului?',
    'Files_ON_Clipboard' => 'Există fișiere în clipboard.',
    'Copy_Cut_Size_Limit' => 'Folderele/fișierele selectate sunt prea mari pentru a %1$s. Limita maximă: %2$d MB/operațiune', // %1$s = cut or copy, %2$d = max size
    'Copy_Cut_Count_Limit' => 'Ați selectat prea multe foldere/fișiere pentru a %1$s. Limita maximă: %2$d files/operațiune', // %1$s = cut or copy, %2$d = max count
    'Copy_Cut_Not_Allowed' => 'Nu aveți permisiuni pentru a %1$s %2$s.', // %12$s = cut or copy, %2$s = files or folders
    'Image_Editor_No_Save' => 'Imaginea nu poate fi salvată',
    'Image_Editor_Exit' => "Exit",
    'Image_Editor_Save' => "Save",
    'Zip_No_Extract' => 'Fisierele din arhivă nu pot fi extrase. Este posibil ca arhiva să fie coruptă.',
    'Zip_Invalid' => 'Extensia nu este suportată. Extensii valide: zip, gz, tar.',
    'Dir_No_Write' => 'Folderul selectat nu are permisiuni de scriere.',
    'Function_Disabled' => 'Funcția %s a fost dezactivată din server.', // %s = cut or copy
    'File_Permission' => 'Permisiuni fișier',
    'File_Permission_Not_Allowed' => 'Modificare permisiunilor pentru %s nu este permisă.', // %s = files or folders
    'File_Permission_Recursive' => 'Execută în mod recursiv?',
    'File_Permission_Wrong_Mode' => "Permisiunea furnizată nu este permisă.",
    'User' => 'Utilizator',
    'Group' => 'Grup',
    'Yes' => 'Da',
    'No' => 'Nu',
    'Lang_Not_Found' => 'Limba aleasă, nu poate fi găsită.',
    'Lang_Change' => 'Modificare limba',
    'File_Not_Found' => 'Fisierul nu poate fi găsit.',
    'File_Open_Edit_Not_Allowed' => 'Nu aveți permisiuni pentru a %s acest fișier.', // %s = open or edit
    'Edit' => 'Editare',
    'Edit_File' => "Editare conținut fișier",
    'File_Save_OK' => "Fișierul a fost salvat cu succes.",
    'File_Save_Error' => "A intervenit o eroare la salvarea fișierului.",
    'New_File' => 'Fișier nou',
    'No_Extension' => 'Este necesar să adăugați o extensie validă la fișier.',
    'Valid_Extensions' => 'Extensii valide: %s', // %s = txt,log etc.
    'Upload_message' => "Drag & drop la fișiere pentru upload",

    'SERVER ERROR' => "EROARE SERVER",
    'forbidden' => "Interzis",
    'wrong path' => "Cale incorectă",
    'wrong name' => "Denumire incorectă",
    'wrong extension' => "Extensie incorectă",
    'wrong option' => "Opțiune incorectă",
    'wrong data' => "Data incorectă",
    'wrong action' => "Acțiune incorectă",
    'wrong sub-action' => "Subacțiune incorectă",
    'no action passed' => "Nicio acțiune nu s-a finalizat",
    'no path' => "Cale inexistentă",
    'no file' => "Fișier inexistent",
    'view type number missing' => "Lipsă număr tip de vizualizare",
    'Not enough Memory' => "Memorie insuficientă",
    'max_size_reached' => "Folderul de imagini a atins dimensiunea maximă de %d MB.", //%d = max overall size
    'B' => "B",
    'KB' => "KB",
    'MB' => "MB",
    'GB' => "GB",
    'TB' => "TB",
    'total size' => "Dimensiune totală",
);
