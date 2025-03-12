<?php
/**
 * Template library templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<script type="text/template" id="template-litho-templateLibrary-header-logo">
	<img src="https://litho.themezaa.com/wp-content/uploads/2020/02/logo-fast-blue-black.png" alt="Logo">
</script>

<script type="text/template" id="template-litho-templateLibrary-header-back">
	<i class="eicon-" aria-hidden="true"></i>
	<span><?php echo __( 'Back to Library', 'litho-addons' ); ?></span>
</script>

<script type="text/template" id="template-litho-TemplateLibrary_header-menu">
	<# _.each( tabs, function( args, tab ) { var activeClass = args.active ? 'elementor-active' : ''; #>
		<div class="elementor-component-tab elementor-template-library-menu-item {{activeClass}}" data-tab="{{{ tab }}}">{{{ args.title }}}</div>
	<# } ); #>
</script>

<script type="text/template" id="template-litho-templateLibrary-header-actions">
	<div id="litho-templateLibrary-header-sync" class="elementor-templates-modal__header__item">
		<i class="eicon-sync" aria-hidden="true" title="<?php esc_attr_e( 'Sync Library', 'litho-addons' ); ?>"></i>
		<span class="elementor-screen-only"><?php esc_html_e( 'Sync Library', 'litho-addons' ); ?></span>
	</div>
</script>

<script type="text/template" id="template-litho-templateLibrary-preview">
    <iframe></iframe>
</script>

<script type="text/template" id="template-litho-templateLibrary-header-insert">
	<div id="elementor-template-library-header-preview-insert-wrapper" class="elementor-templates-modal__header__item">
		{{{ litho.library.getModal().getTemplateActionButton( obj ) }}}
	</div>
</script>

<script type="text/template" id="template-litho-templateLibrary-insert-button">
	<a class="elementor-template-library-template-action elementor-button litho-templateLibrary-insert-button">
		<i class="eicon-file-download" aria-hidden="true"></i>
		<span class="elementor-button-title"><?php esc_html_e( 'Insert', 'litho-addons' ); ?></span>
	</a>
</script>

<script type="text/template" id="template-litho-templateLibrary-pro-button">
	<a class="elementor-template-library-template-action elementor-button litho-templateLibrary-pro-button" href="https://exclusiveaddons.com/pricing/" target="_blank">
		<i class="eicon-external-link-square" aria-hidden="true"></i>
		<span class="elementor-button-title"><?php esc_html_e( 'Get Pro', 'litho-addons' ); ?></span>
	</a>
</script>

<script type="text/template" id="template-litho-templateLibrary-loading">
	<div class="elementor-loader-wrapper">
		<div class="elementor-loader">
			<div class="elementor-loader-boxes">
				<div class="elementor-loader-box"></div>
				<div class="elementor-loader-box"></div>
				<div class="elementor-loader-box"></div>
				<div class="elementor-loader-box"></div>
			</div>
		</div>
		<div class="elementor-loading-title"><?php esc_html_e( 'Loading', 'litho-addons' ); ?></div>
	</div>
</script>

<script type="text/template" id="template-litho-templateLibrary-templates">
	<div id="litho-templateLibrary-toolbar">
		<div id="litho-templateLibrary-toolbar-filter" class="litho-templateLibrary-toolbar-filter">
			<# if ( litho.library.getTypeCategory() ) { #>
	
				<select id="litho-templateLibrary-filter-category" class="litho-templateLibrary-filter-category">
					<option class="litho-templateLibrary-category-filter-item active" value="" data-tag=""><?php esc_html_e( 'Filter', 'litho-addons' ); ?></option>
					<# _.each( litho.library.getTypeCategory(), function( slug ) { #>
						<option class="litho-templateLibrary-category-filter-item" value="{{ slug }}" data-tag="{{ slug }}">{{{ litho.library.getCategory()[slug] }}}</option>
					<# } ); #>
				</select>
			<# } #>
		</div>

		<div id="litho-templateLibrary-toolbar-search">
			<label for="litho-templateLibrary-search" class="elementor-screen-only"><?php esc_html_e( 'Search Templates:', 'litho-addons' ); ?></label>
			<input id="litho-templateLibrary-search" placeholder="<?php esc_attr_e( 'Search', 'litho-addons' ); ?>">
			<i class="eicon-search"></i>
		</div>
	</div>

	<div class="litho-templateLibrary-templates-window">
		<div id="litho-templateLibrary-templates-list"></div>
	</div>
</script>

<script type="text/template" id="template-litho-templateLibrary-template">
	<div class="litho-templateLibrary-template-body" id="litho-template-{{ template_id }}">
		<div class="litho-templateLibrary-template-preview">
			<i class="eicon-zoom-in-bold" aria-hidden="true"></i>
		</div>
		<img class="litho-templateLibrary-template-thumbnail" src="{{ thumbnail }}">
		<div class="litho-templateLibrary-template-title">
			<span>{{{ title }}}</span>
		</div>
	</div>
	<div class="litho-templateLibrary-template-footer">
		{{{ litho.library.getModal().getTemplateActionButton( obj ) }}}
		<a href="#" class="elementor-button litho-templateLibrary-preview-button">
			<i class="eicon-device-desktop" aria-hidden="true"></i>
			<?php esc_html_e( 'Preview', 'litho-addons' ); ?>
		</a>
	</div>
</script>

<script type="text/template" id="template-litho-templateLibrary-empty">
	<div class="elementor-template-library-blank-icon">
		<i class="eicon-search-results"></i>
	</div>
	<div class="elementor-template-library-blank-title"></div>
	<div class="elementor-template-library-blank-message"></div>
	<div class="elementor-template-library-blank-footer">
		<?php esc_html_e( 'Want to learn more about the Exclusive Addons?', 'litho-addons' ); ?>
		<a class="elementor-template-library-blank-footer-link" href="https://exclusiveaddons.com/" target="_blank"><?php echo __( 'Click here', 'litho-addons' ); ?></a>
	</div>
</script>
