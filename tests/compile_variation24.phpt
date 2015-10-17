--TEST--
MarkdownDocument::compile: test GITHUBTAGS flag
--SKIPIF--
<?php
if (!extension_loaded('discount'))
	die('SKIP discount extension not loaded');
--FILE--
<?php
$t = <<<EOD
Test <_arghfoo_bar>
EOD;

$md = MarkdownDocument::createFromString($t);
$md->compile(MarkdownDocument::GITHUBTAGS);
echo $md->getHtml();

echo "\nDone.\n";
--EXPECT--
<p>Test <_arghfoo_bar></p>
Done.
