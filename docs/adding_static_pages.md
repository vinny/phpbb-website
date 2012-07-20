# Static Pages Bundle for Nubs

This is a short guide on how to add a simple static page by just adding a template. It does not require adding routes or controllers.

Here is some parts of the code taken out which might help explain.

	$static_templates_location = ':Static:';
	$template_slug = str_replace('/', '.', $slug);
	$template_location = $static_templates_location . $template_slug . '.html.twig';

The default static templates location is `:Static:` unless there is a different config option. However we don't use this on the www.phpbb.com website. As such the file should be in app/resources/views/static/.

The file should be called the slug but instead of `/` use `.`. So a file you want to appear at /mods/umil/info/ should be located at app/resources/views/static/mods.umil.info.html.twig

It should extend :base:base.twig.html
