<?php 
require_once("include/header.php");
require_once("../src/include.php");

$searchOutcomes = array();
$searched = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    foreach (learningOutcomesLetters() as $letter)
        if ($_POST['checkbox'.$letter]=='on')
            $searchOutcomes[] = $letter;

    $searched = true;
    $matches = getCoursesForOutcomes($searchOutcomes);
}

?>
<form action="search.php" method="POST">
       
            <h2>
                Search by Learning Outcome
            </h2>
            <hr />
            <table id="main_table">
                <tr>
                    <td class="style1">
                        <strong>Letter</strong>
                    </td>
                    <td class="style5">
                        <strong>Description</strong>
                    </td>
                    <td>
                        <strong>Search</strong>
                    </td>
                </tr>
                <tr>
                    <td class="style1">
                        A
                    </td>
                    <td class="style5">
                        Ability to apply knowledge of mathematics, science, engineering.
                    </td>
                    <td class="style3">
                        <input type="checkbox" name="checkboxA" <?php if(in_array('A', $searchOutcomes)) echo "checked"; ?> />
                    </td>
                </tr>
                <tr>
                    <td class="style1">
                        B
                    </td>
                    <td class="style5">
                        An ability to design and conduct experiments, as well as to analyze and interpret
                        data.
                    </td>
                    <td class="style3">
                        <input type="checkbox" name="checkboxB" <?php if(in_array('B', $searchOutcomes)) echo "checked"; ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="style1">
                        C
                    </td>
                    <td class="style5">
                        Ability to design a system, component or process to meet desired needs within realistic
                        constraints such as economic, environmental, social, political, ethical, health
                        and safety, manufacturability, and sustainability.
                    </td>
                    <td class="style3">
                        <input type="checkbox" name="checkboxC" <?php if(in_array('C', $searchOutcomes)) echo "checked"; ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="style1">
                        D
                    </td>
                    <td class="style5">
                        Ability to function on multidisciplinary teams.
                    </td>
                    <td class="style3">
                        <input type="checkbox" name="checkboxD" <?php if(in_array('D', $searchOutcomes)) echo "checked"; ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="style1">
                        E
                    </td>
                    <td class="style5">
                        Ability to identify, formulate and solve engineering problems.
                    </td>
                    <td class="style3">
                        <input type="checkbox" name="checkboxE" <?php if(in_array('E', $searchOutcomes)) echo "checked"; ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="style1">
                        F
                    </td>
                    <td class="style5">
                        Understanding of professional and ethical responsibility.
                    </td>
                    <td class="style3">
                        <input type="checkbox" name="checkboxF" <?php if(in_array('F', $searchOutcomes)) echo "checked"; ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="style1">
                        G
                    </td>
                    <td class="style5">
                        Ability to communicate effectively.
                    </td>
                    <td class="style3">
                        <input type="checkbox" name="checkboxG" <?php if(in_array('G', $searchOutcomes)) echo "checked"; ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="style1">
                        H
                    </td>
                    <td class="style5">
                        The broad education necessary to understand the impact of engineering solutions
                        in a global, economic, environmental and societal context.
                    </td>
                    <td class="style3">
                        <input type="checkbox" name="checkboxH" <?php if(in_array('H', $searchOutcomes)) echo "checked"; ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="style1">
                        I
                    </td>
                    <td class="style5">
                        Recognition of the need for and an ability to engage in lifelong learning.
                    </td>
                    <td class="style3">
                        <input type="checkbox" name="checkboxI" <?php if(in_array('I', $searchOutcomes)) echo "checked"; ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="style1">
                        J
                    </td>
                    <td class="style5">
                        Knowledge of contemporary issues.
                    </td>
                    <td class="style3">
                        <input type="checkbox" name="checkboxJ" <?php if(in_array('J', $searchOutcomes)) echo "checked"; ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="style1">
                        K
                    </td>
                    <td class="style5">
                        Ability to use the techniques, skills and modern engineering tools necessary for
                        engineering practice.
                    </td>
                    <td class="style3">
                        <input type="checkbox" name="checkboxK" <?php if(in_array('K', $searchOutcomes)) echo "checked"; ?>/>
                    </td>
                </tr>
            </table>
            <input id="search_button" type="submit" value="Search" />
			</form>
<?php
    if ($searched)
    {
        echo "<h2>Search results</h2><hr />";
        echo "<strong>Found ".count($matches)." courses matching exactly these ABET learning outcomes.</strong>";
        foreach ($matches as $course)
        {
            $deptName = getProgramLongNameForID($course->deptID);
            echo "<div class='course_name'><a href='course.php?course=$course->courseID'>".$deptName." ".$course->courseNum."</a></div>";
        }
    }
?>
<?php require_once("include/footer.php"); ?>


