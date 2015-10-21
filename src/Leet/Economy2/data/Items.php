<?php

namespace Leet\Economy2\data;

class Items {

    /**
     * Character limit per line is 15!
     * List made using
     * http://minecraft.gamepedia.com/Pocket_Edition_data_values
     */

    public static $items = [
        '0:0' => 'air',
        '1:0' => 'stone',
        '1:1' => 'granite',
        '1:2' => 'polishedgranite',
        '1:3' => 'diorite',
        '1:4' => 'polisheddiorite',
        '1:5' => 'andesite',
        '1:6' => 'polishandesite',
        '2:0' => 'grassblock',
        '3:0' => 'dirt',
        '4:0' => 'cobblestone',
            '5:0' => 'oakplank',
            '5:1' => 'spruceplank',
            '5:2' => 'birchplank',
            '5:3' => 'jungleplank',
            '5:4' => 'acaciaplank',
            '5:5' => 'darkoakplank',
        '6:0' => 'oaksapling',
            '6:1' => 'sprucesapling',
            '6:2' => 'birchsapling',
            '6:3' => 'junglesapling',
            '6:4' => 'acaciasapling',
            '6:5' => 'darkoaksapling',
        '7:0' => 'bedrock',
        '8:0' => 'water',
        '9:0' => 'stillwater',
        '10:0' => 'lava',
        '11:0' => 'stilllava',
        '12:0' => 'sand',
        '13:0' => 'gravel',
        '14:0' => 'goldore',
        '15:0' => 'ironore',
        '16:0' => 'coalore',
        '17:0' => 'oakwood',
            '17:1' => 'sprucewood',
            '17:2' => 'birchwood',
            '17:3' => 'junglewood',
            '162:0' => 'acaciawood',
            '162:1' => 'darkoakwood',
        '18:0' => 'oakleaves',
            '18:1' => 'spruceleaves',
            '18:2' => 'birchleaves',
            '18:3' => 'jungleleaves',
            '161:0' => 'acacialeaves',
            '161:1' => 'darkoakleaves',
        '19:0' => 'sponge',
        '20:0' => 'glass',
        '21:0' => 'lapisore',
        '22:0' => 'lapisblock',
        '24:0' => 'sandstone',
            '24:1' => 'chisestandstone',
            '24:2' => 'smoothsandstone',
        '27:0' => 'poweredrail',
        '30:0' => 'cobweb',
        '31:0' => 'tallgrass',
        '32:0' => 'deadbush',
        '35:0' => 'wool',
            '35:1' => 'orangewool',
            '35:2' => 'magentawool',
            '35:3' => 'lightbluewool',
            '35:4' => 'yellowwool',
            '35:5' => 'limewool',
            '35:6' => 'pinkwool',
            '35:7' => 'graywool',
            '35:8' => 'lightgraywool',
            '35:9' => 'cyanwool',
            '35:10' => 'purplewool',
            '35:11' => 'bluewool',
            '35:12' => 'brownwool',
            '35:13' => 'greenwool',
            '35:14' => 'redwool',
            '35:15' => 'blackwool',
        '37:0' => 'dandelion',
        '38:0' => 'flower',
            '38:1' => 'blueorchid',
            '38:2' => 'allium',
            '38:3' => 'bluet',
            '38:4' => 'redtulip',
            '38:5' => 'orangetulip',
            '38:6' => 'whitetulip',
            '38:7' => 'pinktulip',
            '38:8' => 'daisy',
        '39:0' => 'brownmushroom',
        '40:0' => 'redmushroom',
        '41:0' => 'goldblock',
        '42:0' => 'ironblock',
        '43:0' => 'doublestoneslab',
            '43:1' => 'doublesandslab',
            '43:2' => 'doublewoodslab',
            '43:3' => 'cobbleslabs',
            '43:4' => 'doublebrickslab',
            '43:5' => 'stonebrickslabs',
            '43:6' => 'netherslabs',
            '43:7' => 'quartzslabs',
            '43:8' => 'smoothstoneslab',
            '43:9' => 'tilequartzslab',
        '44:0' => 'stoneslab',
            '44:1' => 'sandstoneslab',
            '44:2' => 'woodslab',
            '44:3' => 'cobblestoneslab',
            '44:4' => 'brickslab',
            '44:5' => 'stonebrickslab',
            '44:6' => 'netherbrickslab',
            '44:7' => 'quartzslab',
            '44:8' => 'upperstoneslab',
            '44:9' => 'uppersandslab',
            '44:10' => 'upperwoodslab',
            '44:11' => 'uppercobbleslab',
            '44:12' => 'upperbrickslab',
            '44:13' => 'upperstonebslab',
            '44:14' => 'uppernetherslab',
            '44:15' => 'upperquartzslab',
        '45:0' => 'bricks',
        '46:0' => 'tnt',
        '47:0' => 'bookshelf',
        '48:0' => 'mossstone',
        '49:0' => 'obsidian',
        '50:0' => 'torch',
        '51:0' => 'fire',
        '52:0' => 'monsterspawner', # No support for custom mob spawners?
        '53:0' => 'oakwoodstairs',
            '67:0' => 'cobblestairs',
            '108:0' => 'brickstairs',
            '109:0' => 'stonebrickstair',
            '114:0' => 'netherstairs',
            '128:0' => 'sandstonestairs',
            '134:0' => 'sprucestairs',
            '135:0' => 'birchstairs',
            '136:0' => 'junglestairs',
            '156:0' => 'quartzstairs',
            '164:0' => 'darkoakstairs',
            '180:0' => 'redsandstairs',
            '203:0' => 'purpurstairs',
            '163:0' => 'acaciastairs',
        '54:0' => 'chest',
        '56:0' => 'diamondore',
        '57:0' => 'diamondblock',
        '58:0' => 'craftingtable',
        '60:0' => 'farmland',
        '61:0' => 'furnace',
        '62:0' => 'burningfurnace',
        '68:0' => 'wallsign',
        '324:0' => 'woodendoor',
            '193:0' => 'sprucedoor',
            '194:0' => 'birchdoor',
            '195:0' => 'jungledoor',
            '196:0' => 'acaciadoor',
            '197:0' => 'darkoakdoor',
            '330:0' => 'irondoor',
        '65:0' => 'ladder',
        '66:0' => 'rail',
        '73:0' => 'redstoneore',
        '78:0' => 'snow',
        '79:0' => 'ice',
        '80:0' => 'snowblock',
        '81:0' => 'cactus',
        '82:0' => 'clayblock',
        '85:0' => 'fence',
            '188:0' => 'sprucefence',
            '189:0' => 'birchfence',
            '190:0' => 'junglefence',
            '191:0' => 'darkoakfence',
            '192:0' => 'acaciafence',
            '113:0' => 'netherfence',
        '86:0' => 'pumpkin',
        '87:0' => 'netherrack',
        '88:0' => 'soulsand',
        '89:0' => 'glowstone',
        '90:0' => 'portal',
        '91:0' => 'jackolantern',
        '96:0' => 'trapdoor',
        '167:0' => 'irontrapdoor',
        '97:0' => 'monsteregg',
            '97:1' => 'cobblestoneegg',
            '97:2' => 'stonebrickegg',
            '97:3' => 'mossystoneegg',
            '97:4' => 'crackedstoneegg',
        '97:5' => 'chiseledegg',
        '98:0' => 'stonebrick',
        '98:1' => 'mossybrick',
        '98:2' => 'crackedbrick',
        '98:3' => 'chiseledbrick',
        '99:0' => 'mushroomblock',
        '100:0' => 'redshroomblock',
        '101:0' => 'ironbars',
        '102:0' => 'glasspane',
        '103:0' => 'melonblock',
        '104:0' => 'pumpkinstem',
        '105:0' => 'melonstem',
        '106:0' => 'vines',
        '107:0' => 'fencegate',
            '183:0' => 'sprucegate',
            '184:0' => 'birchgate',
            '185:0' => 'junglegate',
            '186:0' => 'darkoakgate',
            '187:0' => 'acaciagate',
        '110:0' => 'mycelium',
        '111:0' => 'lilypad',
        '112:0' => 'netherbricks',
        '116:0' => 'enchantingtable',
        '120:0' => 'endportalframe',
        '121:0' => 'endstone',
        '127:0' => 'cocoa',
        '129:0' => 'emeraldore',
        '133:0' => 'emeraldblock',
        '139:0' => 'cobblewall',
        '139:1' => 'mossycobblewall',
        '390:0' => 'flowerpot',
            '140:1' => 'poppypot',
            '140:2' => 'dandelionpot',
            '140:3' => 'oakpot',
            '140:4' => 'sprucepot',
            '140:5' => 'birchpot',
            '140:6' => 'junglepot',
            '140:7' => 'redshroompot',
            '140:8' => 'brownshroompot',
            '140:9' => 'cactuspot',
            '140:10' => 'deadbushpot',
            '140:11' => 'fernpot',
            '140:12' => 'acaciapot',
            '140:13' => 'darkoakpot',
        '141:0' => 'carrot',
        '391:0' => 'carrots',
        '392:0' => 'potato',
        '142:0' => 'potatoes',
        '143:0' => 'mobhead',
            '143:1' => 'witherskeleton',
            '143:2' => 'zombiehead',
            '143:3' => 'head',
            '143:4' => 'creeperhead',
        '144:0' => 'anvil',
            '144:1' => 'damagedanvil',
            '144:2' => 'verydamageanvil',
        '152:0' => 'redstoneblock',
        '153:0' => 'netherquartzore',
        '155:0' => 'quartz',
            '155:1' => 'chiseledquartz',
            '155:2' => 'pillarquartz',
        '159:0' => 'stainedclay',
            '159:1' => 'orangeclay',
            '159:2' => 'magentaclay',
            '159:3' => 'lightblueclay',
            '159:4' => 'yellowclay',
            '159:5' => 'limeclay',
            '159:6' => 'pinkclay',
            '159:7' => 'grayclay',
            '159:8' => 'lightgrayclay',
            '159:9' => 'cyanclay',
            '159:10' => 'purpleclay',
            '159:11' => 'blueclay',
            '159:12' => 'brownclay',
            '159:13' => 'greenclay',
            '159:14' => 'redclay',
            '159:15' => 'blackclay',
            '170:0' => 'haybale',
            '171:0' => 'carpet',
                '171:1' => 'orangecarpet',
                '171:2' => 'magentacarpet',
                '171:3' => 'lightbluecarpet',
                '171:4' => 'yellowcarpet',
                '171:5' => 'limecarpet',
                '171:6' => 'pinkcarpet',
                '171:7' => 'graycarpet',
                '171:8' => 'lightgraycarpet',
                '171:9' => 'cyancarpet',
                '171:10' => 'purplecarpet',
                '171:11' => 'bluecarpet',
                '171:12' => 'browncarpet',
                '171:13' => 'greencarpet',
                '171:14' => 'redcarpet',
                '171:15' => 'blackcarpet',
            '172:0' => 'hardenedclay',
            '173:0' => 'coalblock',
            '174:0' => 'iceblock',
            '175:0' => 'sunflower',
            '198:0' => 'grasspath',
            '243:0' => 'podzol',
            '245:0' => 'stonecutter',
            '246:0' => 'glowingobsidian',
            '247:0' => 'netherreactor', # Only items from here on.
            '256:0' => 'ironshovel',
            '257:0' => 'ironpickaxe',
            '258:0' => 'ironaxe',
            '259:0' => 'flintandsteel',
            '260:0' => 'apple',
            '261:0' => 'bow',
            '262:0' => 'arrow',
            '263:0' => 'coal',
            '264:0' => 'diamond',
            '265:0' => 'ironingot',
            '266:0' => 'goldingot',
            '267:0' => 'ironsword',
            '268:0' => 'woodensword',
            '269:0' => 'woodenshovel',
            '270:0' => 'woodenpickaxe',
            '271:0' => 'woodenaxe',
            '272:0' => 'stonesword',
            '273:0' => 'stoneshovel',
            '274:0' => 'stonepickaxe',
            '275:0' => 'stoneaxe',
            '276:0' => 'diamondsword',
            '277:0' => 'diamonshovel',
            '278:0' => 'diamondpickaxe',
            '279:0' => 'diamondaxe',
            '280:0' => 'stick',
            '281:0' => 'bowl',
            '282:0' => 'mushroomstew',
            '283:0' => 'goldsword',
            '284:0' => 'goldshovel',
            '285:0' => 'goldpickaxe',
            '286:0' => 'goldaxe',
            '287:0' => 'string',
            '288:0' => 'feather',
            '289:0' => 'gunpowder',
            '290:0' => 'woodenhoe',
                '291:0' => 'stonehoe',
                '292:0' => 'ironhoe',
                '293:0' => 'diamondhoe',
                '294:0' => 'goldhoe',
            '295:0' => 'seeds',
            '296:0' => 'wheat',
            '297:0' => 'bread',
            '298:0' => 'leathercap',
            '299:0' => 'leathertunic',
            '300:0' => 'leatherpants',
            '301:0' => 'leatherboots',
            '302:0' => 'chainhelmet',
            '303:0' => 'chainchest',
            '304:0' => 'chainleggings',
            '305:0' => 'chainboots',
            '306:0' => 'ironhelmet',
            '307:0' => 'ironchest',
            '308:0' => 'ironleggings',
            '309:0' => 'ironboots',
            '310:0' => 'diamondhelmet',
            '311:0' => 'diamondchest',
            '312:0' => 'diamondleggings',
            '313:0' => 'diamondboots',
            '314:0' => 'goldenhelmet',
            '315:0' => 'goldenchest',
            '316:0' => 'goldenleggings',
            '317:0' => 'goldenboots',
            '318:0' => 'flint',
            '319:0' => 'rawporkchop',
            '320:0' => 'cookedporkchop',
            '321:0' => 'painting',
            '322:0' => 'goldenapple',
            '323:0' => 'sign',
            '325:0' => 'bucket',
            '328:0' => 'minecart',
            '329:0' => 'saddle',
            '331:0' => 'redstone',
            '332:0' => 'snowball',
            '333:0' => 'boat',
            '334:0' => 'leather',
            '336:0' => 'brick',
            '337:0' => 'clay',
            '338:0' => 'sugarcane',
            '339:0' => 'paper',
            '340:0' => 'book',
            '341:0' => 'slimeball',
            '344:0' => 'egg',
            '345:0' => 'compass',
            '346:0' => 'fishingrod',
            '347:0' => 'clock',
            '348:0' => 'glowstonedust',
            '349:0' => 'rawfish',
            '350:0' => 'cookedfish',
            '351:0' => 'inksac',
                '351:1' => 'reddye',
                '351:2' => 'greendye',
                '351:3' => 'browndye',
                '351:4' => 'bluedye',
                '351:5' => 'purpledye',
                '351:6' => 'cyandye',
                '351:7' => 'lightgraydye',
                '351:8' => 'graydye',
                '351:9' => 'pinkdye',
                '351:10' => 'limedye',
                '351:11' => 'yellowdye',
                '351:12' => 'lightbluedye',
                '351:13' => 'magentadye',
                '351:14' => 'orangedye',
                '351:15' => 'bonemeal',
            '352:0' => 'bone',
            '353:0' => 'sugar',
            '354:0' => 'cake',
            '355:0' => 'bed',
            '357:0' => 'cookie',
            '359:0' => 'shears',
            '360:0' => 'melon',
            '361:0' => 'pumpkinseeds',
            '362:0' => 'melonseeds',
            '363:0' => 'rawbeef',
            '364:0' => 'steak',
            '365:0' => 'rawchicken',
            '366:0' => 'cookedchicken',
            '367:0' => 'rottenflesh',
            '368:0' => 'blazerod',
            '369:0' => 'ghasttear',
            '370:0' => 'goldnugget',
            '371:0' => 'netherwart',
            '372:0' => 'potion',
            '373:0' => 'spidereye',
            '374:0' => 'fermentedeye',
            '375:0' => 'blazepowder',
            '376:0' => 'magmacream',
            '377:0' => 'brewingstand',
            '378:0' => 'glisteringmelon',
            '383:0' => 'spawnegg',
                '383:50' => 'creeperegg',
                '383:51' => 'skeletonegg',
                '383:52' => 'spideregg',
                '383:54' => 'zombieegg',
                '383:55' => 'slimeegg',
                '383:56' => 'ghastegg',
                '383:57' => 'zombiepigmanegg',
                '383:58' => 'endermanegg',
                '383:59' => 'cavespideregg',
                '383:60' => 'silverfishegg',
                '383:61' => 'blazeegg',
                '383:62' => 'magmacubeegg',
                '383:65' => 'bategg',
                '383:66' => 'witchegg',
                '383:67' => 'endermiteegg',
                '383:69' => 'shulkeregg',
                '383:90' => 'pigegg',
                '383:91' => 'sheepegg',
                '383:92' => 'cowegg',
                '383:93' => 'chickenegg',
                '383:94' => 'squidegg',
                '383:95' => 'wolfegg',
                '383:96' => 'mooshroomegg',
                '383:98' => 'ocelotegg',
                '383:100' => 'horseegg',
                '383:101' => 'rabbitegg',
                '383:120' => 'villageregg',
            '384:0' => 'enchantingflask',
            '388:0' => 'emerald',
            '393:0' => 'bakedpotato',
            '394:0' => 'poisonouspotato',
            '396:0' => 'goldencarrot',
            '400:0' => 'pumpkinpie',
            '403:0' => 'enchantedbook',
            '405:0' => 'netherbrick',
            '406:0' => 'netherquartz',
            '414:0' => 'rabbitfoot',
            '438:0' => 'splashpotion',
            '457:0' => 'beetroot',
            '458:0' => 'beetrootseeds',
            '459:0' => 'beetrootsoup'
    ];

    /**
     * @param $name
     * @return String|null
     */
    public static function getIdMeta($name) {
        $position = array_search(strtolower($name), self::$items);
        if(!$position) return null;
        return $position;
    }

    /**
     * @param $key
     * @return String|null
     */
    public static function getName($key) {
        if(count(explode(':', $key)) < 2) $key = $key.':0';
        if(!isset(self::$items[$key])) return null;
        return self::$items[$key];
    }

}
