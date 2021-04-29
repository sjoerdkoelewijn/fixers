<?php
/**
 * Add a support dashboard widget.
 */
add_action('wp_dashboard_setup', 'add_skdd_support_dashboard_widget' );

function skdd_support_dashboard_widget() { ?>

    <div class="skdd_dashboard_widget skdd_contact">
                
        <p>
            Kom je er niet uit met de uitleg van de meest voorkomende taken? 
            <br>
            Neem dan contact op via:
            <br><br> 
            <a href="mailto:hello@sjoerdkoelewijn.com">hello@sjoerdkoelewijn.com</a> 
            <a href="tel:0031641537244">06 41 53 72 44</a>
        </p>

    </div>
	
<?php }

function skdd_tutorial_dashboard_widget() { ?>
    
    <div class="skdd_dashboard_widget skdd_tutorial">

        <p>Klik op de links hieronder voor een uitleg van de meest voorkomende taken.</p>
        
        <a href="#">Hoe maak je een nieuwe pagina aan.</a>
        <a href="#">Hoe kan ik een block toevoegen aan een pagina.</a>
        <a href="#">Hoe voeg ik een block template toe aan een pagina.</a>
        <a href="#">Hoe maak je een eigen block template aan.</a>
        <a href="#">Hoe voeg je nieuwe menu items toe.</a>

    </div>

<?php }

function add_skdd_support_dashboard_widget() {
	
	wp_add_dashboard_widget(
			'skdd_help_widget', // Widget ID
			__( 'Hulp nodig?', 'SKDD' ), // Widget title
			'skdd_support_dashboard_widget' // Widget function callback
	);

    wp_add_dashboard_widget(
        'skdd_tutorial_widget', // Widget ID
        __( 'Meest voorkomende taken', 'SKDD' ), // Widget title
        'skdd_tutorial_dashboard_widget' // Widget function callback
);
}