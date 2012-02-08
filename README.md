Setup
=====
The group owner and permissions must be set properly so that Apache can read/write to the data files. On webtest, it should be assigned as:

    chown -R :web-apache data
    chmod –R g+w data

Also, on each system, the `$ROOT` must be set in `src/include.php`. This is the absolute path to the root of the system. For example, for user rlourens on webtest:

    $ROOT = '/home/ugrad1/rlourens/WWW/'; 

If you are not sure what this path is, execute `pwd` from the root folder (which contains data, src, prototype, etc.)

Directory structure
===================
    data
        courses
            <courseID>
                <all assignment-related files>
                <courseID>.json
                <courseID.#.json (old versions)
        master
            designators.json (mapping of abbrevations to printable abbreviations, e.g. coms -> Com S)
            index.json (mapping of abbrevations to full names, e.g. coms -> Computer Science)
            users.json (not currently used)
        program
            <abbrevation>.json (list of courses associated with this name)
    documents
        (there is a list of HTML element ids here, but nothing critical)
    lib
        (the json schema php lib is here, but isn't currently in use. Left in case we decide to re-add json validation, but this is now sort of done in the model objects themselves)
    prototype
        (front-end related code)
    src
        (back-end code related to the model and data management)
    utils
        (more schema-related stuff, not currently used)
