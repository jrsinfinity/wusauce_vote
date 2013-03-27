<!DOCTYPE html>
    <meta charset="utf-8">
    <title>Voting Results</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">



    <!-- Le styles -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if IE]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  
  </head>

  <body>

    <div class="container">
    <div class="row">
     <div class="span6 offset3">
      <h1><?php echo getenv('TWILIO_NUMBER'); ?></h1>

      <div class="well">
        <table>
          <tr>
            <th class="span1">ID</th>
            <th class="span3">Team</th>
            <th class="span2">Votes</th>
          </tr>
        <?php
          require('application.php');
          foreach ($choices as $number => $choice) {
            echo "<tr>
                    <td>$number</td>
                    <td>$choice</td>
                    <td>" . count_votes( $number ) . "</td>
                    </td>";
          }
          ?>
        </table>
      </div>
     </div>
   </div>
  </body>
</html>
