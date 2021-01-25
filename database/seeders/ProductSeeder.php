<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'cat_id' => '1',
                'name' => 'Saveur Impériale',
                'description' => 'Sachet de thé de qualité supérieure.200 sachets par boite',
                'image' => '',
                'price' => '4.99',
            ],
            [
                'cat_id' => 2,
                'name' => "Assortiment de biscuits secs",
                'description' => "Boîte de 20 biscuits composée de galettes, cookies, crêpes dentelles et sablés",
                'image' => "assortimentBiscuitsSecs.jpg",
                'price' => 12.9,
            ],
            [
                'cat_id' => 2,
                'name' => "Biscuits de Noël",
                'description' => "De doux biscuits de Noël à la cannelle, au chocolat, et sablés pour assurer de belles et uniques fêtes de Noël",
                'image' => "biscuitNoel.png",
                'price' => 10.5
            ],
            [
                'cat_id' => 2,
                'name' => "Biscuits aux raisins",
                'description' => "De délicieux biscuits aux raisins secs pour éveiller les sens de toute la famille, des plus petits aux plus grands !",
                'image' => "biscuitRaisin.jpeg",
                'price' => 6.9,
            ],
            [
                'cat_id' => 3,
                'name' => "Pruneaux secs bio",
                'description' => "Sachet de 500g . De délicieux pruneaux issus d agricultures biologiques et responsables",
                'image' => "pruneauxSecs.jpg",
                'price' => 7.9
            ],
            [
                'cat_id' => 3,
                'name' => "Sachet d'abricots secs",
                'description' => "Sachet d'un kilogramme . Produit recommandé par de nombreux nutritionnistes . Authentique goût d'abricot",
                'image' => "abricotsSecs.jpg",
                'price' => 15.5
            ],
            [
                'cat_id' => 3,
                'name' => "Plateau de fruits secs",
                'description' => "Plateau de 1kg composé d'abricots secs, de noix de cajous, pruneaux secs, bananes sèches, copeaux de noix de coco...",
                'image' => "plateauFruitsSecs.jpg",
                'price' => 32
            ],
            [
                'cat_id' => 3,
                'name' => "Mélange de fruits secs",
                'description' => "Composés de différents sachets de 250g : des marrons, des cacahouètes, des amandes grillés et des noisettes . ",
                'image' => "melangeMarrons.jpg",
                'price' => 25
            ],
            [
                'cat_id' => 3,
                'name' => "Mélange de noisettes",
                'description' => "Sachet de 500g composé de noisettes, noix et amandes grillées . Une fois goûtés, on ne peut plus s'en passer",
                'image' => "melangeNoisettes.png",
                'price' => 8.3
            ],
            [
                'cat_id' => 3,
                'name' => "Sachet d'amandes grillées",
                'description' => "Sachet de 500g, grillées lentement au four pour plus de plaisir en bouche lors de la dégustation !",
                'image' => "amandes.jpg",
                'price' => 9.9
            ],
            [
                'cat_id' => 1,
                'name' => "Jus de citron",
                'description' => "Bouteille d'un litre de jus de citron frais issus d'agricultures responsables et biologiques",
                'image' => "jusCitron.jpg",
                'price' => 5.2
            ],
            [
                'cat_id' => 1,
                'name' => "Jus de pommes",
                'description' => "Pommes issues d'agricultures biologiques.Bouteille d'un litre dans une bouteille en verre ",
                'image' => "jusPomme.jpg",
                'price' => 3.2
            ],
            [
                'cat_id' => 1,
                'name' => "Jus de pamplemousse",
                'description' => "Bouteille d'un litre et demi sans sucre et sans colorant ajoutés. 100% naturel au bon goût de pamplemousse",
                'image' => "jusPamplemousse.jpg",
                'price' => 7.3
            ],
            [
                'cat_id' => 1,
                'name' => "Jus d'orange",
                'description' => "Oranges provenant d'agricultures locales et biologiques. Cette bouteille d'un litre permet de se réveiller en douceur le matin.",
                'image' => "jusOrange.jpg",
                'price' => 4.6
            ],
            [
                'cat_id' => 1,
                'name' => "Sachet de café en grain",
                'description' => "sachet d'un kilogramme de café en grain, pour garder l'authentique goût du café pour bien commencer la journée",
                'image' => "cafeGrain.jpg",
                'price' => 15
            ],
            [
                'cat_id' => 1,
                'name' => "Capsules de café",
                'description' => "Paquet de 50 capsules. Adaptable pour toute sortes de machines à café avec capsules",
                'image' => "cafeCapsule.jpg",
                'price' => 45
            ],
            [
                'cat_id' => 1,
                'name' => "Dosettes de café",
                'description' => "Paquet de 30 dosettes de café . Longue date de conservation . Emballage recyclable respectant l'environnement.",
                'image' => "dosetteCafe.png",
                'price' => 28.1
            ],
            [
                'cat_id' => 1,
                'name' => "Infusion à la verveine",
                'description' => "Recommandé pour profiter de nuits calmes. Vendus par paquet de 15 sachets.",
                'image' => "infusionVerveine.jpg",
                'price' => 8.9
            ],
            [
                'cat_id' => 1,
                'name' => "Sachets de thé à la canelle",
                'description' => "15 sachets à l'authentique gout de thé à la cannelle . Nouveauté chez Web4Shop ! ",
                'image' => "theCannelle.jpg",
                'price' => 10.5
            ],
            [
                'cat_id' => 1,
                'name' => "Thé vert",
                'description' => "20 sachets de thé vert . Les adeptes en raffolent et on comprend bien pourquoi ! ",
                'image' => "theVert.jpg",
                'price' => 13.9
            ],
            [
                'cat_id' => 1,
                'name' => "Infusion au citron",
                'description' => "Paquet de 20 sachets d'infusion au citron pour partager un moment unique avec les plus petits ou les plus grands",
                'image' => "infusionCitron.jpg",
                'price' => 15.3
            ],
            [
                'cat_id' => 2,
                'name' => "Macarons tout chocolat",
                'description' => "Macarons uniques au chocolat . Vendus par 10 macarons dans une très belle boîte",
                'image' => "macaronChocolat.jpg",
                'price' => 20.5
            ],
            [
                'cat_id' => 2,
                'name' => "Boules de neige",
                'description' => "Boules aromatisées à la noix de coco.Plateau de 200g. Idée cadeau qui va plaire aux adeptes de la noix de coco !",
                'image' => "bouleDeNeigeCoco.jpg",
                'price' => 10.8
            ],
            [
                'cat_id' => 2,
                'name' => "Cookies au pépites de chocolat",
                'description' => "Cookies croquants préparés avec de l'avoine et des pépites de chocolat fondantes. Paquet de 15 cookies",
                'image' => "cookiesChocolat.jpg",
                'price' => 12.3
            ],
            [
                'cat_id' => 2,
                'name' => "Biscuits étoile à la cannelle",
                'description' => "Biscuits secs pour noël à l'authentique goût de la cannelle. L'éveil des sens avec ces saveurs est assuré !",
                'image' => "biscuitsCannelle . jpg",
                'price' => 13.5
            ],
            [
                'cat_id' => 2,
                'name' => "Biscuits en forme de tortue",
                'description' => "Paquet de 20 petits biscuits en forme de tortue . Goût chocolat vanille . Leur très jolie forme va séduire tout le monde !",
                'image' => "biscuitsTortue.jpg",
                'price' => 25.3
            ],
        ];


        foreach ($products as $key => $value) {

            Product::create($value);

        }
    }
}
