<?php

namespace Blacksmith\Console\Commands\Furnace;

use Illuminate\Filesystem\Filesystem;
use Pluma\Support\Console\Command;

class ForgeWeaponCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:weapon
                           {name=Iron Dagger : The kind of weapon to forge}
                           ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new weapon (Not really. This is just a test.)';

    /**
     * Test variables.
     *
     * @var mixed
     */
    protected $items;

    protected $total;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $file)
    {
        $name = $this->argument('name');
        $options = $this->options(); // None, but it's here because it's a demo.

        $this->info($this->getApropriateGreeting());

        // The Shop's Sign
        $this->line("+====================================+");
        $this->line("|           Welcome to the           |");
        $this->line("|        BLACKSMITH's FURNACE        |");
        $this->line("+====================================+");
        $this->line("        ||                  ||       ");
        // $this->line("        ||                  ||       ");
        $this->line("     +==========================+    ");
        $this->line("     |    Home of the Finest    |    ");
        $this->line("     |    Weapons and Armors    |    ");
        $this->line("     +==========================+    ");

        // /The Shop's Sign

        // Check if $name was given
        if ("Iron Dagger" == $name) {
            $name = $this->ask("What weapon/s would you want me to forge? Separate with comma", "Iron Dagger");
            $name = explode(",", $name);
        }

        if (is_array($name)) {
            foreach ($name as $name) {
                $this->thinkItOver($name);
            }
        } else {
            $this->thinkItOver($name);
        }

        sleep(1);

        $this->line("");
        $this->line("Alright...");

        sleep(1);

        $this->line("Breakdown:");
        $headers = ['[ ]', 'Weapon/Armor', 'Price', 'Quantity', 'Total'];
        $items = $this->items;
        $this->table($headers, $items);

        sleep(1);

        $this->line("That would be <info>{$this->total} gold pence</info>");
        $q = count($this->items) > 1 ? 'them' : 'it';
        $days = count($this->items) > 1 ? count($this->items) . " weeks" : count($this->items) . " week";
        $this->line("You can come pick $q up $days from now.");

        sleep(1);

        $this->line("Pleasure doing business with you.");
    }

    protected function getApropriateGreeting()
    {
        $time = date("H");
        $address = ['traveller', 'kinsman', 'chap', 'Thane', 'stranger'];
        $address = $address[rand(0, (count($address)-1))];
        switch ($time) {
            case $time < 12:
                $greet = "Top of the morning, $address";
                break;
            case $time == 12:
                $greet = "Good noon, $address";
                break;
            case $time > 12 && $time < 18:
                $greet = "Good afternoon, $address";
                break;
            case $time > 12 && $time >= 18:
                $greet = "A fine evening, $address";
                break;
            default:
                $greet = "Good day";
                break;
        }

        return $greet;
    }

    protected function thinkItOver($name)
    {
        $name = ucwords(trim($name));

        sleep(1); // wait 1 second for dramatic effect.

        $this->line("");
        $this->line("You've ordered <info>$name</info>.");

        sleep(1);

        $quantity = $this->ask("How many '$name' do you want?", 1);

        sleep(1);

        $basePrice = rand(100, 5000);
        $price = $basePrice * $quantity;

        $this->items[] = ['[x]', $name, $basePrice, $quantity, $price];
        $this->total += $price;
    }
}
