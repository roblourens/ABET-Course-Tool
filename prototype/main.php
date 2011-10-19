<?php require_once("include/header.php");?>
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
       <a href="viewAllCourses.php">View All Courses</a><br />
   <a href="search.php">Search By Learning Outcome</a><br />
   <a href="">View All Learning Outcomes</a><br />
                        </div>
                    </td>
                    <td>
                        <h3>
                            My Courses
                        </h3>
                        <table>
                       
                            <tr>
                                <td>
                                    <a href="course.php?course=se319">SE 319</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
             </form>
<?php require_once("include/footer.php"); ?>

