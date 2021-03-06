--TEST--
MarkdownDocument::compile: test NODLIST flag (markdown style)
--COMMENT--
This is currently leaking memory.
--SKIPIF--
<?php
if (!extension_loaded('discount'))
	die('SKIP discount extension not loaded');
--FILE--
<?php
$t = <<<EOD
Apple
:   Pomaceous fruit of plants of the genus Malus in 
    the family Rosaceae.

Orange
:   The fruit of an evergreen tree of the genus Citrus.

EOD;

$md = MarkdownDocument::createFromString($t);
$md->compile(MarkdownDocument::DLEXTRA);
echo $md->getHtml(), "\n\n";

echo "=====================\n";

$md = MarkdownDocument::createFromString($t);
$md->compile(MarkdownDocument::DLEXTRA | MarkdownDocument::NODLIST);
echo $md->getHtml(), "\n\n";

echo "\nDone.\n";
--EXPECT--
<dl>
<dt>Apple</dt>
<dd>  Pomaceous fruit of plants of the genus Malus in
  the family Rosaceae.</dd>
<dt>Orange</dt>
<dd>  The fruit of an evergreen tree of the genus Citrus.</dd>
</dl>

=====================
<p>Apple
:   Pomaceous fruit of plants of the genus Malus in
    the family Rosaceae.</p>

<p>Orange
:   The fruit of an evergreen tree of the genus Citrus.</p>


Done.
