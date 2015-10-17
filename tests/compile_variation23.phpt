--TEST--
MarkdownDocument::compile: test FENCEDCODE flag
--SKIPIF--
<?php
if (!extension_loaded('discount'))
	die('SKIP discount extension not loaded');
--FILE--
<?php
$t = <<<EOD
First line

~~~
# My code

Foo bar
~~~

```md
# H1
## H2
### H3
#### H4
##### H5
###### H6
```
EOD;

$md = MarkdownDocument::createFromString($t);
$md->compile(MarkdownDocument::FENCEDCODE);
echo $md->getHtml();

echo "\nDone.\n";
--EXPECT--
<p>First line</p>

<pre><code># My code

Foo bar
</code></pre>

<pre><code class="md"># H1
## H2
### H3
#### H4
##### H5
###### H6
</code></pre>
Done.
