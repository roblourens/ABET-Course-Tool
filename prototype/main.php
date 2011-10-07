<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>ABET: Welcome</title>
    <link href="css/site.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        #main_table {
            width: 50%;
            margin: auto;
        }
        td {

            vertical-align:top;
        }

        .view_link {
            margin-top: 10px;
        }
    </style>

</head>
<body>
    <div class="page">
        <div class="header">
            <div class="title">
                <h1>
                    ABET Software Application
                </h1>
            </div>
            <div class="loginDisplay">
                [ <a href="" id="HeadLoginView_HeadLoginStatus">Log In</a> ]
            </div>
        </div>
        <div class="main">
            <h2>
                Welcome
            </h2>
            <hr />
            <table id="main_table" style="">
                <tr>
                    <td>
                        <div>
                            <h3>
                                Find a course
                            </h3>
                            <select>
                                <option value="se">Software Engineering</option>
                                <option value="cpre">Computer Engineering</option>
                            </select>
                            <select>
                                <option value="101">101</option>
                                <option value="319">319</option>
                            </select>
                            <input type="submit" value="Go"/>
                        </div>
                        <div class="view_link">
                            <input type="submit" value="View all courses" />
                        </div>
                        <div class="view_link">
                            <input type="submit" value="Search by learning outcome" />
                        </div>
                        <div class="view_link">
                            <input type="submit" value="View all learning outcomes" />
                        </div>
                    </td>
                    <td>
                        <h3>
                            My Courses
                        </h3>
                        <table>
                            <tr>
                                <td>
                                    <a href="view.php?course=cpre101">CprE 101</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="view.php?course=se319">SE 319</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer">
    </div>
    <script type='text/javascript'>        new Sys.WebForms.Menu({ element: 'NavigationMenu', disappearAfter: 500, orientation: 'horizontal', tabIndex: 0, disabled: false });</script>
    </form>
</body>
</html>

