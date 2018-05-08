<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
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