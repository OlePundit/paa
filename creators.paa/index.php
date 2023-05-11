<?php 
session_start();
include('includes/config.php');
include('includes/functions.php');
include('includes/header.php');

error_reporting(0);
?>

<?php
$email=$_SESSION['login'];
$sql ="SELECT Avatar,Niche FROM creators WHERE Email=:mail";
$query= $dbh -> prepare($sql);
$query-> bindParam(':mail', $email, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if (is_null($results[0]->Avatar) || empty($results[0]->Avatar) || is_null($results[0]->Niche) || empty($results[0]->Niche)) {
    echo "Please <a href='profile.php'>complete your profile</a>";
}
?>
        <main>
           <div class="col-12 mx-5 mb-5 mt-5">
            Nikola founder Trevor Milton on Friday was convicted by a jury of fraud in a case alleging he lied to investors about the electric vehicle company’s technology.

            The jury found Milton guilty on one count of securities fraud and two counts of wire fraud after deliberating for around five hours. Milton was acquitted on an additional count of securities fraud.

            During the trial in federal court in Manhattan, prosecutors depicted Milton, 40, as a “con man” who sought to deceive investors about the electric- and hydrogen-powered truck maker’s technology starting in November 2019.

            Milton, wearing a blue suit and green tie, shook his head as the jurors confirmed their verdict. His attorney said he will file court papers challenging the verdict.

            Milton, of Oakley, Utah, was indicted in July 2021. He left Nikola in September 2020 after a report by short seller Hindenburg Research called the company a “fraud.”

            Prosecutors accused Milton of using social media and interviews on television, podcasts and in print to make false and misleading claims about Nikola’s trucks and technology.

            They said Milton’s improper statements included that Nikola built an electric- and hydrogen-powered “Badger” pickup from the “ground up,” developed batteries in-house that he knew it was purchasing elsewhere and had early success in creating a “Nikola One” semi-truck he knew did not work.
           </div>
        </main>
        
        <footer id="footer" class="footer bg-dark text-white">
            <div class="footer-content">
                <div class="container">
                    <div class="row  g-5">
                        <div class="col-12 ">
                            <ul class="footer-links list-unstyled align-items-baseline">
                                <li>Contact us</li>
                                <li>About</li>
                                <li>Social Links</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>