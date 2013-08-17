<?php

namespace phpBB\WebsiteInterfaceBundle\Wrappers;

class PhpbbTextHandling
{
	public function bbcodeStripping($text)
	{
		$text = preg_replace("#\[\/?[a-z0-9\*\+\-]+(?:=(?:&quot;.*&quot;|[^\]]*))?(?::[a-z])?(\:[0-9a-z]{5,})\]#", ' ', $text);
		$match = array(
			'#<!\-\- e \-\-><a href="mailto:(.*?)">.*?</a><!\-\- e \-\->#',
			'#<!\-\- l \-\-><a (?:class="[\w-]+" )?href="(.*?)(?:(&amp;|\?)sid=[0-9a-f]{32})?">.*?</a><!\-\- l \-\->#',
			'#<!\-\- ([mw]) \-\-><a (?:class="[\w-]+" )?href="(.*?)">.*?</a><!\-\- \1 \-\->#',
			'#<!\-\- s(.*?) \-\-><img src="\{SMILIES_PATH\}\/.*? \/><!\-\- s\1 \-\->#',
			'#<!\-\- .*? \-\->#s',
			'#<.*?>#s',
		);
		$replace = array('\1', '\1', '\2', '\1', '', '');

		$text = preg_replace($match, $replace, $text);

		return $text;
	}
}
