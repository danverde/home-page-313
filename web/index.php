<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css" /> -->
    <style>
@import url("https://fonts.googleapis.com/css?family=Roboto:400,900");
body {
  margin: 0px;
  padding: 0px;
  box-sizing: inherit; }

.inline {
  display: inline-block; }

.floatRight {
  float: right; }

/* Default fonts */
* {
  font-family: 'Roboto', sans-serif; }

.emphasis {
  color: #009f00;
  font-weight: 700; }

p {
  font-size: 14pt; }

/* End fonts */
ul li {
  list-style: none; }

h1,
h2,
h3,
h4,
h5,
h6 {
  text-transform: uppercase;
  color: #009f00; }

h1 {
  font-size: 50pt; }

h2 {
  font-size: 30pt; }

.headline {
  border-bottom: 1px solid #909090; }

/* Default links */
a,
a:visited {
  color: green; }

a:hover {
  color: #009f00; }

/* End  Links*/
/* Buttons */
.button {
  padding: 10px;
  text-decoration: none;
  background-color: green;
  color: white;
  border-radius: 7px;
  cursor: pointer; }
  .button:hover {
    background-color: #009f00;
    color: white; }
  .button:visited {
    color: white; }

/* End Buttons */
/* Forms */
form {
  display: flex;
  flex-flow: wrap;
  justify-content: space-between;
  max-width: 500px; }

input {
  font-size: 12pt;
  padding: 6px;
  border: none;
  border-radius: 5px; }

textarea {
  font-size: 12pt;
  padding: 6px;
  border: none;
  border-radius: 5px;
  width: 100%;
  display: block;
  margin: 20px 0; }

.fa-facebook-square {
  color: #4267B2; }

.fa-linkedin-square {
  color: #0077B5; }

.fa-github-square {
  color: black; }

/* End Forms */
.all-caps {
  text-transform: uppercase; }

header {
  z-index: 99;
  background-color: #009f00;
  height: 75px;
  width: 100%;
  border-bottom: 4px solid lightgray;
  position: fixed;
  opacity: 0.9;
  color: white; }
  header nav {
    margin-top: 3px;
    font-size: 18pt;
    height: 100%;
    padding: 20px;
    display: flex;
    align-content: center;
    justify-content: flex-end;
    align-items: baseline; }
    header nav span {
      margin-right: auto; }
    header nav a,
    header nav a:visited {
      color: white;
      font-size: 14pt;
      margin: 0 15px; }
    header nav a:hover {
      color: #eaeaea; }

/* individual sections */
main {
  margin: 0;
  padding: 0;
  background-color: lightgray; }
  main section {
    display: flex;
    overflow: hidden; }

#intro {
  min-height: 100vh;
  align-items: center;
  justify-content: center;
  position: relative; }
  #intro .scrollBox {
    margin-top: -100px;
    color: #009f00;
    background-color: rgba(0, 0, 0, 0.6);
    text-align: center;
    height: 300px;
    width: 700px; }

#projects .scrollBox {
  box-shadow: 10px 10px 5px #888888;
  background-color: #eaeaea;
  color: black; }
  #projects .scrollBox h2 {
    margin: 0 0 auto auto; }
#projects .fa {
  padding-right: 20px !important; }

#contact .formWrapper {
  margin-bottom: 20px;
  padding-bottom: 20px; }

.statusMsg {
  width: 75%;
  text-align: center;
  border-radius: 5px;
  display: block;
  line-height: 2.4;
  opacity: 0;
  transition: opacity 1s; }

.successMsg {
  background-color: #bafdba;
  border: 1px solid #19a819;
  opacity: 1; }

.errMsg {
  background-color: #fdbaba;
  border: 1px solid #a81919;
  opacity: 1; }

/* End Individual Sections */
#about h2 {
  border-bottom: 1px solid #909090; }

/* Scrolling effect */
.sectionWrapper {
  position: relative;
  width: 100%;
  max-width: 800px;
  margin: 10vmin auto;
  padding: 0 20px; }

.scrollBox {
  z-index: 0;
  opacity: 0;
  position: absolute;
  height: 100%;
  width: 100%;
  max-width: 800px;
  top: -100vh;
  left: 0;
  padding: 20px;
  color: white;
  transition: all 1s; }

.moveIn {
  opacity: 1;
  top: 0vh; }

/* End Scrolling effect */
/* Parallax effect */
.bg-content {
  opacity: 0.9; }

.bg-img {
  min-height: 100vh;
  background-size: cover;
  background-attachment: fixed;
  background-repeat: no-repeat;
  background-position: center;
  background-color: lightgray; }

.bg-1 {
  background-image: url("assets/img1.jpg"); }

.bg-2 {
  background-image: url("../images/img2.jpg"); }

.bg-3 {
  background-image: url("../images/img3.jpg"); }

/*# sourceMappingURL=style.css.map */

</style>
    <script src="main.js"></script>
</head>

<body onload="scrollBox('#intro .scrollBox')">
    <?php   
        require 'header.php'
    ?>

    <main>
        <section class="bg-img bg-1 all-caps" id="intro">
            <div class="sectionWrapper">
                <div class="scrollBox">
                    <h1 class="all-caps">&lt;Daniel Green/&gt;</h1>
                    <h2>&lt;Front End Web developer/&gt;</h2>
                </div>
            </div>
        </section>

        <section class="bg-content" id="about">
            <div class="sectionWrapper">
                <h2 class="headline">About Me</h2>
                <p>The first thing you need to know about me is that I'm a
                    <span class="emphasis">small dog kind of guy</span>, an amateur photographer, and a car enthusiast. Now on to the boring stuff!
                </p>
                <p>I'm currently a
                    <span class="emphasis">student</span> and a part-time
                    <span class="emphasis">Front-End Web Developer</span> for Brigham Young University-Idaho. When it comes to design, I believe
                    that
                    <span class="emphasis">simple is better</span>. I spend my days maintaining a section of the University homepage, slaving away
                    on homework, and writing custom tools for pretty much any faculty member that asks.</p>
                <p></p>
                <p>I speak fluent
                    <span class="emphasis">HTML5</span>,
                    <span class="emphasis">CSS3</span>,
                    <span class="emphasis">JavaScript</span>, and Spanish. I also know SASS,
                    <span class="emphasis">NodeJS</span>, and SVG images. I am currently learning Angular5 and Python 2.7. I hope to learn C# and
                    .NET before I graduate in early 2018.</p>
                <p> I've studied PHP, mySQL, and Oracle SQL in the past, but they've gotten a bit rusty since I've focused on
                    JavaScript. I'm more than happy to brush up on these skills if necessary.</p>
                <p>I've got a
                    <span class="emphasis">passion</span> for code and for the web. I know how to work hard and I love to learn! </p>
            </div>
        </section>

        <section class="bg-img bg-2">
        </section>

        <section class="bg-content" id="assignments">
            <div class="sectionWrapper">
                <h2 class="headline">Assignments</h2>
                <p>More Coming soon!</p>
                <ul>
                    <li>
                        <a href="helloWorld.html">Hello World</a>
                    </li>
                </ul>
            </div>
        </section>
    </main>
</body>

</html>