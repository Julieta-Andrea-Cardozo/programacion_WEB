<?php
/**
 * Catálogo de productos que se renderiza del lado del servidor.
 */

$bebidas = [
    ['img' => 'espresso.jpg', 'alt' => 'Espresso servido en vaso de vidrio', 'etiqueta' => 'Signature', 'nombre' => 'Espresso Clásico', 'precio' => 1800, 'descripcion' => 'Extracción pura de 30 ml con crema densa y aroma intenso. Origen: Etiopía Yirgacheffe.'],
    ['img' => 'flat-white.jpg', 'alt' => 'Flat white con arte latte en forma de hoja', 'etiqueta' => 'Popular', 'nombre' => 'Flat White', 'precio' => 2400, 'descripcion' => 'Doble ristretto con leche texturizada en microespuma. Equilibrio perfecto entre café y lácteo.'],
    ['img' => 'cold-brew.jpg', 'alt' => 'Vaso de cold brew con hielo', 'etiqueta' => 'Temporada', 'nombre' => 'Cold Brew Tónica', 'precio' => 2900, 'descripcion' => 'Infusión de 18 horas en frío sobre agua tónica y hielo. Refrescante y con notas cítricas.'],
    ['img' => 'latte.jpg', 'alt' => 'Latte con corazón dibujado en la espuma', 'etiqueta' => 'Con leche', 'nombre' => 'Latte', 'precio' => 2300, 'descripcion' => 'Espresso con abundante leche vaporizada y una fina capa de espuma sedosa.'],
    ['img' => 'iced-latte.jpg', 'alt' => 'Iced latte en vaso alto con hielo', 'etiqueta' => 'Frío', 'nombre' => 'Iced Latte', 'precio' => 2600, 'descripcion' => 'Doble shot sobre leche fría y hielo. Suave, cremoso y perfecto para el verano.'],
    ['img' => 'americano.jpg', 'alt' => 'Taza de café americano sobre plato celeste', 'etiqueta' => 'Clásico', 'nombre' => 'Americano', 'precio' => 2000, 'descripcion' => 'Espresso alargado con agua caliente para resaltar las notas del grano.'],
];

$granos = [
    ['img' => 'grano-etiopia.jpg', 'alt' => 'Granos de café en una lata', 'meta' => 'África · Lavado · 250 g', 'nombre' => 'Ethiopia Yirgacheffe', 'estrellas' => 5, 'notas' => 'Jazmín · Durazno · Limón', 'precio' => 4200],
    ['img' => 'grano-colombia.jpg', 'alt' => 'Granos de café tostado', 'meta' => 'América · Natural · 250 g', 'nombre' => 'Colombia Huila', 'estrellas' => 5, 'notas' => 'Caramelo · Uva · Chocolate', 'precio' => 3800],
    ['img' => 'grano-guatemala.jpg', 'alt' => 'Bolsa de arpillera llena de granos de café', 'meta' => 'América · Honey · 250 g', 'nombre' => 'Guatemala Antigua', 'estrellas' => 4, 'notas' => 'Nuez · Canela · Miel', 'precio' => 3400],
    ['img' => 'grano-brasil.jpg', 'alt' => 'Granos de café tostado de cerca', 'meta' => 'América · Natural · 250 g', 'nombre' => 'Brasil Cerrado', 'estrellas' => 4, 'notas' => 'Chocolate · Avellana · Bajo', 'precio' => 2900],
];

$insumos = [
    ['img' => 'insumo-molino.jpg', 'alt' => 'Molino de café eléctrico sobre la mesada', 'meta' => 'Molienda', 'nombre' => 'Molino de Disco Cerámico', 'estrellas' => 5, 'notas' => '40 graduaciones, ideal para espresso y filtrado', 'precio' => 38000],
    ['img' => 'insumo-kit.jpg', 'alt' => 'Kit de barista con tamper, café molido y taza', 'meta' => 'Accesorios', 'nombre' => 'Kit Barista Inicial', 'estrellas' => 4, 'notas' => 'Tamper, jarra y tabla de golpes', 'precio' => 12500],
    ['img' => 'insumo-portafiltro.jpg', 'alt' => 'Portafiltros con café molido y granos', 'meta' => 'Espresso', 'nombre' => 'Tamper 58 mm Acero', 'estrellas' => 5, 'notas' => 'Base plana y mango ergonómico', 'precio' => 8900],
    ['img' => 'insumo-bolsa.jpg', 'alt' => 'Bolsa de café de especialidad', 'meta' => 'Suscripción', 'nombre' => 'Box Mensual Barismo', 'estrellas' => 5, 'notas' => 'Dos orígenes sorpresa por mes', 'precio' => 7500],
];

function precio(int $monto): string
{
    return '$' . number_format($monto, 0, ',', '.');
}

function estrellas(int $cantidad): string
{
    return str_repeat('★', $cantidad) . str_repeat('☆', 5 - $cantidad);
}
