<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .accordion {
            background-color: #444;

            cursor: pointer;
            padding: 8px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
            transition: 0.4s;
        }

        .active,
        .accordion:hover {
            background-color: #000;
        }

        .panel {
            padding: 0 18px;
            display: none;
            background-color: white;
            overflow: hidden;
        }

        .sidebar ul {
            text-decoration: none;
            list-style-type: none;

        }

        @font-face {
            font-family: 'lifecraftfont';
            src: url('../fonts/lifecraftfont.woff');
        }

        .sidebar {
            color: #e9d839;


            margin: 0;
        }


        .sidebar,
        button {
            font-family: 'lifecraftfont';
            color: #e9d839;
        }

        /* unvisited link */
        a:link {
            color: #e9d839;
            text-decoration: none;

        }

        /* visited link */
        a:visited {
            color: #e9d839;
            text-decoration: none;
        }

        /* mouse over link */
        a:hover {
            color: hotpink;
        }

        /* selected link */
        a:active {
            color: blue;
        }

        .classes {

            background: none;
            cursor: pointer;
            padding: 8px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
            transition: 0.4s;
        }

        .druid {
            color: #FF7D0A !important;
        }

        .druid a {
            color: #FF7D0A !important;
        }
        
                .paladin a {
            color: #F58CBA !important;
        }
                .paladin{
            color: #F58CBA !important;
        }

        Hunter Mage Paladin Priest Rogue Shaman Warlock Warrior
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Accordion</h2>

        <button class="accordion">General</button>
        <div class="panel">
            <ul>
                <li><a href="#">Gold Making Guide</a></li>
                <li><a href="#">Levelling Guide</a></li>
                <li><a href="#">Reputation Guide</a></li>
            </ul>
        </div>

        <button class="accordion">Class Guides</button>
        <div class="panel">
            <ul>

                <!-- Druid class guide start -->
                
                <button class="classes">

                    <li><a href="#" class="druid">Druid</a></li>
                </button>
                <div class="panel">
                    <ul class="druid">
                        <li><a href="#">Balance</a></li>
                        <li><a href="#">Feral</a></li>
                        <li><a href="#">Restoration</a></li>
                    </ul>
                </div>

                <!-- Druid class guide end -->



                <li><a href="#">Hunter</a></li>
                <li><a href="#">Mage</a></li>
                
                                <!-- Paladin class guide start -->
                
                <button class="classes">

                    <li><a href="#" class="paladin">Paladin</a></li>
                </button>
                <div class="panel">
                    <ul class="paladin">
                        <li><a href="#">Holy</a></li>
                        <li><a href="#">Protection</a></li>
                        <li><a href="#">Retribution</a></li>
                    </ul>
                </div>

                <!-- paladin class guide end -->
                
                
                
                <li><a href="#">Priest</a></li>
                <li><a href="#">Rogue</a></li>
                <li><a href="#">Shaman</a></li>
                <li><a href="#">Warlock</a></li>
                <li><a href="#">Warrior</a></li>

            </ul>
        </div>

        <button class="accordion">PvE</button>
        <div class="panel">
            <p>insert nav</p>
        </div>

        <button class="accordion">PvP</button>
        <div class="panel">
            <p>insert nav</p>
        </div>

        <button class="accordion">Attunements</button>
        <div class="panel">
            <ul>
                <li><a href="#">Molten Core</a></li>
                <li><a href="#">Onyxia</a></li>
                <li><a href="#">Blackwing Lair</a></li>
                <li><a href="#">Naxxramass</a></li>
            </ul>
        </div>

        <button class="accordion">Raids</button>
        <div class="panel">
            <p>insert nav</p>
        </div>
    </div>
    <script>
        var acc = document.getElementsByClassName("classes");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.display === "block") {
                    panel.style.display = "none";
                } else {
                    panel.style.display = "block";
                }
            });
        }


        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.display === "block") {
                    panel.style.display = "none";
                } else {
                    panel.style.display = "block";
                }
            });
        }
    </script>

</body>

</html>