<?php

/**
 * Plugin Name: Hola, Tío Simón
 * Plugin URI: https://yordansoar.es/
 * Description: This plugin display quotes from song lyrics by Venezuelan Singer-songwriter Simón Díaz in dashboard.
 * Author: Yordan Soares
 * Author URI: https://yordansoar.es/
 * Version: 1.0
 * Requires at least: 4.6
 * Requires PHP: 7.0
 * Text domain: hola-tio-simon
 * Domain Path: /languages
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Salimos del programa si el archivo se abre directamente
if (!defined('ABSPATH')) {
	exit;
}

// Cargamos el texto de dominio para añadir internacionalización
load_plugin_textdomain('hola-tio-simon', FALSE,	dirname(plugin_basename(__FILE__)) . '/languages');

function hola_tio_simon_letras()
{

	/** «El Alcaraván» Lyrics */
	$lyrics = "El perico en el conuco, la totuma en el corral y hasta el gallo carraspea cuando pasa un animal
	Allá en mi pueblo cuando pasa un alcaraván, se asustan las muchachas por el beso del morichal
  El perro de la casa se levanta y sale pa'llá, pa'lla pa' fuera porque no le gusta pelear
	Que fuiste tu, que si yo, que no, que si tú, te vieron que llevabas cafecito al morichal
	Y que Pedro, en los maizales, tus espigas reventaba
	Y esa noche la luna se puso bonita, clarita, que hasta Pedro se asusta si pasa algún alcaraván
	";

	/** «El Becerrito (La Vaca Mariposa)» Lyrics */
	$lyrics .= "La vaca Mariposa tuvo un terné, un becerrito lindo como un bebé
	<em>Dámelo papaito</em> dicen los niños cuando lo ven nacer y ella lo esconde por los mogotes que no sé
	La vaca Mariposa tuvo un terné, la sabana le ofrece reverdecer
	Los arroyitos todos le llevan flores por el amanecer y ella lo esconde por los mogotes que no sé
  ...y los pericos van y el gavilán también, con frutas criollas hasta el caney, para él
	...y mariposa está que no sabe que hacer, por que ella sabe la suerte de él
  La sabana le ofrece reverdecer, los arroyitos todos le llevan flores por el amanecer
	...y ella lo esconde por los mogotes que no sé, la vaca Mariposa tuvo un terné
	";

	/** «Garcita» Lyrics */
	$lyrics .= "Me voy camino a garcita, donde están los comederos, donde la palma y el río aumentan mi desespero
	Río crecido, río crecido, rebaja tu tempestad que los chinchorros de noche se mueren de soledad
	Fruta e' palma, fruta e' palma, acompáñame al andar que contigo y mis sudores es más bonito llegar
	Bebe bebe, cabrestero, bebe de mi morichal, que muchos guaitacaminos te faltan para llegar 
	Me voy camino a Garcita... río crecido, río crecido
	";

	/** «Mi Querencia» Lyrics */
	$lyrics .= "Lucero de la mañana, préstame tu claridad para alumbrarle los pasos a mi amante que se va
	Si pasas algún trabajo lejos de mi soledad, dile al lucero del alba que te vuelva a regresar
	Si mi querencia es el monte, y mi fuerza un cimarrón, ¿cómo no quieres que cante como canta un corazón?
	Si mi querencia es el monte, y la flor de araguaney, ¿cómo no quieres que tenga tantas ganas de volver?
	Si mi querencia es el monte, y una punta de ganao, ¿cómo no quieres que sueñe con el sol de los vena'os
	";

	/** «Tonada de Luna Llena» Lyrics */
	$lyrics .= "Yo vide una garza mora dándole combate a un río, así es como se enamora tu corazón con el mío
	Anda muchacho a la casa , y me traes, la carabina jioo, pa' matá este gavilán que no me deja gallina
	La luna me esta mirando, yo no sé lo que me ve, yo tengo la ropa limpia, ayer tarde la lavé";

	// Dividimos las cadenas en lineas separadas
	$lyrics = explode("\n", $lyrics);

	// Elegimos una línea aleatoria y eliminamos los espacios al principio y al final
	$lyrics = trim(wptexturize($lyrics[mt_rand(0, count($lyrics) - 1)]));

	// Devolvemos la línea elegida
	return $lyrics;
}

// Tomamos la linea elegida, añadimos el atributo de idioma y preparamos el párrafo para mostrar
function hola_tio_simon()
{
	$chosen = hola_tio_simon_letras();
	$lang   = '';
	if ('es_' !== substr(get_user_locale(), 0, 3)) {
		$lang = ' lang="es"';
	}

	printf(
		'<p id="tio-simon"><span class="screen-reader-text">%s </span><span dir="ltr"%s>«%s»</span> <strong>—Simón Díaz</strong></p>',
		__('Quote from song lyrics by Simón Díaz:', 'hola-tio-simon'),
		$lang,
		$chosen
	);
}

// Mostramos la línea en el escritorio
add_action('admin_notices', 'hola_tio_simon');

// Añadimos el CSS necesario para posicionar el párrafo
function hola_tio_simon_css()
{
	echo "
	<style type='text/css'>
	#tio-simon {
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #tio-simon {
		float: left;
	}
	.block-editor-page #tio-simon {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#tio-simon,
		.rtl #tio-simon {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action('admin_head', 'hola_tio_simon_css');
