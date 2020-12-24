<!DOCTYPE html>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta content="text/html;charset=UTF-8" http-equiv="content-type">
    <title>PhyD3</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-material-design.min.css" />
    <link rel="stylesheet" href="css/phyd3.css" />
    <link rel="stylesheet" href="css/dataTables.bootstrap.css" />
    <link rel="stylesheet" href="css/phyd3.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/material.min.js"></script>
    <script src="js/newick.js"></script>
    <script src="js/d3.v3.min.js" type="text/javascript"></script>
    <script src="js/colorbrewer.js" type="text/javascript"></script>
    <script src="js/Blob.js" type="text/javascript"></script>
    <script src="js/canvas-toBlob.js" type="text/javascript"></script>
    <script src="js/canvg.js" type="text/javascript"></script>
    <script src="js/FileSaver.js" type="text/javascript"></script>
    <script src="js/phyd3.phyloXML.js" type="text/javascript"></script>
    <script src="js/phyd3.phylogram.js" type="text/javascript"></script>
    <script>
        var opts = {
            dynamicHide: true,
            height: 800,
            invertColors: false,
            lineupNodes: true,
            showDomains: true,
            showDomainNames: false,
            showDomainColors: true,
            showGraphs: true,
            showGraphLegend: true,            
            showLength: false,
            showNodeNames: true,
            showNodesType: "all",
            showPhylogram: false,
            showTaxonomy: true,
            showFullTaxonomy: true,
            showSequences: true,
            showTaxonomyColors: true,
            backgroundColor: "#f5f5f5",
            foregroundColor: "#000",
        };

        function () {
            $("#familyID").val("HOM03D000802");
            loadTree();
        }
        function loadTree() {            
            d3.select("#phyd3").text("Loading...");
            <?php if ($_GET['f'] == 'xml') { ?>
            //shlomtzion
/*            <? php 
//            $Run_Number = $_GET['run_number']; ?>
            var dir ="<?=$Run_Number;?>" ;
            // var dir ="<?=$_GET['run_number'];?>" ;
             var full_dir = "/bioseq/data/results/multicrispr/".concat(dir.concat("tree.xml"));//hard code - to change!!!
            d3.xml(full_dir, function(xml) {
                  d3.select("#phyd3").text(null);
                  var tree = phyd3.phyloxml.parse(xml);
                  phyd3.phylogram.build("#phyd3", tree, opts);
*/     //             });
            //shlomtzion
//                d3.xml("submissions/<?php echo $_GET['id']?>", function(xml) {
				  d3.xml("samples/sample.xml", function(xml) {
                   d3.select("#phyd3").text(null);
                    var tree = phyd3.phyloxml.parse(xml);
                    phyd3.phylogram.build("#phyd3", tree, opts);
                });

            <?php } else if ($_GET['f'] == 'newick') { ?>
 //               d3.text("submissions/<?php echo $_GET['id']?>", function(xml) {
				  d3.text("samples/tree.newick", function(xml) {
                    d3.select("#phyd3").text(null);
                    var tree = Newick.parse(xml);
                    console.log(tree);
                    phyd3.phylogram.build("#phyd3", tree, opts);
                });
            <?php } ?>
        };
    </script>
</head>
<body onload="load()" class="container">    
    <br />
    <a href="https://phyd3.bits.vib.be/"><img id="phyd3logo" src="img/logo-name.svg" /></a>
    <a href="http://www.vib.be"><img id="viblogo" src="img/vib_tagline_pos_rgb.png" /></a>
    <div class="row phyd3-controls well">
        <div class="col-xs-3">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                      <input id="dynamicHide" type="checkbox" checked="checked"> dynamic node hiding
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                      <input id="invertColors" type="checkbox"> invert colors
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                      <input id="phylogram" type="checkbox" checked="checked"> show phylogram
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                      <input id="lineupNodes" type="checkbox" checked="checked"> lineup nodes
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                      <input id="lengthValues" type="checkbox"> show branch length values
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                      <input id="supportValues" type="checkbox"> show support values
                    </label>
                </div>
            </div>    
            <div class="form-group">
                <div class="checkbox">
                    <label>
                      <input id="nodeNames" type="checkbox" checked="checked"> show node names
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                      <input id="sequences" type="checkbox" checked="checked"> show sequences
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                      <input id="taxonomy" type="checkbox" checked="checked"> show taxonomy
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 text-right left-dropdown middle-padding">show</div>
                <div class="col-xs-5 no-padding">
                <select id="nodesType" class="form-control">
                    <option>all</option>
                    <option selected="selected">only leaf</option>
                    <option>only inner</option>
                </select>
                </div>
                <div class="col-xs-4 text-left right-dropdown middle-padding">
                nodes
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                      <input id="taxonomyColors" type="checkbox" checked="checked"> taxonomy colorization
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    node size
                </div>
                <div class="col-xs-3 text-right">
                    <button id="nodeHeightLower" class="btn btn-primary" title="make them smaller"><span class="glyphicon glyphicon-zoom-out" aria-hidden="true"></span></button>
                </div>
                <div class="col-xs-3 text-center middle-padding">
                    <input type="text" id="nodeHeight" disabled="disabled" class="form-control" />
                </div>
                <div class="col-xs-3 text-left">
                    <button id="nodeHeightHigher" class="btn btn-primary" title="make them bigger"><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span></button>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-xs-offset-4 text-center">
                    <button id="zoominY" class="btn btn-primary" title="zoom in along Y axis"><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span> Y</button>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 text-center">
                    <button id="zoomoutX" class="btn btn-primary" title="zoom out along X axis"><span class="glyphicon glyphicon-zoom-out" aria-hidden="true"></span> X</button>
                </div>
                <div class="col-xs-4 text-center">
                    <button id="resetZoom" class="btn btn-link">RESET</button>
                </div>
                <div class="col-xs-4 text-center">
                    <button id="zoominX" class="btn btn-primary" title="zoom in along X axis"><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span> X</button>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-xs-offset-4 text-center">
                    <button id="zoomoutY" class="btn btn-primary" title="zoom out alongY axis"><span class="glyphicon glyphicon-zoom-out" aria-hidden="true"></span> Y</button>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                      <input id="domains" type="checkbox" checked="checked"> show domain architecture
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                      <input id="domainNames" type="checkbox"> show domain names
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                      <input id="domainColors" type="checkbox" checked="checked"> domain colorization
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    domain scale
                </div>
                <div class="col-xs-3 text-right">
                    <button id="domainWidthLower" class="btn btn-primary" title="make them shorter"><span class="glyphicon glyphicon-zoom-out" aria-hidden="true"></span></button>
                </div>
                <div class="col-xs-3 text-center middle-padding">
                    <input type="text" id="domainWidth" disabled="disabled" class="form-control no-padding" />
                </div>
                <div class="col-xs-3 text-left">
                    <button id="domainWidthHigher" class="btn btn-primary" title="make them longer"><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span></button>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-xs-3">
                    p &nbsp; value
                </div>
                <div class="col-xs-3 text-right">
                    <button id="domainLevelLower" class="btn btn-primary" title="lower the threshold">-</button>
                </div>
                <div class="col-xs-3 text-center middle-padding">
                    <input type="text" id="domainLevel" disabled="disabled" class="form-control no-padding" />
                </div>
                <div class="col-xs-3 text-left">
                    <button id="domainLevelHigher" class="btn btn-primary" title="higher the threshold">+</button>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                      <input id="graphs" type="checkbox" checked="checked"> show graphs
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                      <input id="graphLegend" type="checkbox" checked="checked"> show legend
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    graph scale
                </div>
                <div class="col-xs-3 text-right">
                    <button id="graphWidthLower" class="btn btn-primary" title="make them shorter"><span class="glyphicon glyphicon-zoom-out" aria-hidden="true"></span></button>
                </div>
                <div class="col-xs-3 text-center middle-padding">
                    <input type="text" id="graphWidth" disabled="disabled" class="form-control" />
                </div>
                <div class="col-xs-3 text-left">
                    <button id="graphWidthHigher" class="btn btn-primary" title="make them longer"><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span></button>
                </div>
            </div>
            <br />
            <div class="row">
                Download as:
                <button class="btn btn-primary" id="linkSVG">SVG</button>
                <button class="btn btn-primary" id="linkPNG">PNG</button>
                <a href="submissions/<?php //echo $_GET['id']?>" class="btn btn-primary" id="linkXML" download >XML</a>
            </div>
        </div>
        <div id="phyd3" class="col-xs-9"></div>        
        <div class="col-sm-9 col-sm-offset-3 text-center">
            Use your mouse to drag &amp; zoom the tree. <strong>Tip:</strong> CTRL + wheel = scale Y, ALT + wheel = scale X<br />
            You can use the URL of this page as permalink.
        </div>
    </div>
    <script type="text/javascript">
        $.material.init();
    </script>
</body>
</html>