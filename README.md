# wiki-infobox-api
Attempt to get information from Wikipedia [Infoboxes](https://en.wikipedia.org/wiki/Help:Infobox).
## Usage
Get keys and values from the Infobox on [Nikola Tesla's Wikipedia page.](https://en.wikipedia.org/wiki/Nikola_Tesla)
## Display keys
```php
include_once 'wiki-infobox-api.php';

$infobox = new infobox('Nikola Tesla');

$arr = $infobox->infobox_arr;

foreach($arr as $val)
{
    printf($val->key . "\n");
}
```
```
name
image
alt
caption
birth_name
birth_date
birth_place
death_date
death_place
citizenship
resting_place
education
module
discipline
institutions
practice_name
employer
significant_projects
significant_design
significant_advance
significant_awards
```
## Display values
```
include_once 'wiki-infobox-api.php';

$infobox = new infobox('Nikola Tesla');

$arr = $infobox->infobox_arr;

foreach($arr as $val)
{
    printf($val->value . "\n");
}
```
```
Nikola Tesla
N.Tesla.JPG
Photograph of Nikola Tesla, a slender, moustachioed man with a thin face and pointed chin.
Nikola Tesla, {{circa|1896}}
[Empty]
{{Birth date|1856|7|10|df=yes}}
[[Smiljan]], [[Austrian Empire]] (modern-day [[Croatia]])
{{Death date and age|1943|1|7|1856|7|10|df=yes}}
[[New York City]], United States
<!-- nationality -->Austrian (1856–1891)<br/>American {{No wrap|(1891–1943)}}
[[Nikola Tesla Museum]], [[Belgrade, Serbia]]
[[Graz University of Technology]] (abandoned)
{{Infobox engineering career
Electrical engineering,<br />Mechanical engineering
[Empty]
[Empty]
[Empty]
[[Alternating current]],<br />high-voltage, high-frequency power experiments
[[Wardenclyffe Tower|Tesla Tower]]/[[World Wireless System]]/[[Wireless power transfer]]<br />[[Tesla Experimental Station]]<br />[[Tesla's Egg of Columbus]]<br />[[Tesla coil]]/[[Resonant inductive coupling]]<br />[[Tesla turbine]]<br />[[Tesla valve]]<br />[[Tesla's oscillator]]<br />[[Polyphase system]]<br />[[AC motor]]/[[Induction motor]]<br />[[Rotating magnetic field]]<br />[[Radio control]]<br />[[Plasma globe]]<br />[[Plasma lamp]]<br />[[Carbon button lamp]]<br />[[Teleforce]]/[[Death ray]]<br />[[Telegeodynamics]]<br />[[Teleoperation]]<br />[[Torpedo]] {{sfn|Jonnes|2004|p=355}}<br />[[Vacuum variable capacitor]]<br />[[Violet ray]]<br />[[VTOL]]
[Empty]
{{collapsible list | title            = {{nbsp}}|[[Order of St. Sava]], II Class, Government of Serbia (1892)<br />[[Elliott Cresson Medal]] (1894)<br />[[Order of Prince Danilo I]] (1895)<br />[[Edison Medal]] (1916)<br />[[Order of St. Sava]], I Class, Government of Yugoslavia (1926)<br />[[Order of the Yugoslav Crown]] (1931)<br />[[John Scott Medal]] (1934)<br />[[Order of the White Eagle (Serbia)|Order of the White Eagle]], I Class, Government of Yugoslavia (1936)<br />[[Order of the White Lion]], I Class, Government of Czechoslovakia (1937)<br/>University of Paris Medal (1937)<br/>The Medal of the University St Clement of Ochrida, [[Sofia, Bulgaria]] (1939)}}
}}
```
