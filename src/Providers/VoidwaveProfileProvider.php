<?php

namespace PhantomVoidTTV\VoidwaveTheme\Providers;

use App\Enums\TabPosition;
use App\Enums\TablerIcon;
use App\Filament\Pages\Auth\EditProfile;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Support\ServiceProvider;

class VoidwaveProfileProvider extends ServiceProvider
{
    public function register(): void
    {
        EditProfile::registerCustomTabs(
            TabPosition::After,
            Tab::make('voidwave')
                ->label('Voidwave')
                ->icon(TablerIcon::Stars)
                ->schema([
                    Section::make('Voidwave appearance')
                        ->description('These choices synchronize to your Pelican account and apply on every panel page.')
                        ->icon(TablerIcon::Palette)
                        ->columns(2)
                        ->schema($this->appearanceFields()),
                ]),
        );
    }

    /** @return array<\Filament\Schemas\Components\Component> */
    private function appearanceFields(): array
    {
        return [
            Toggle::make('voidwave_effects')
                ->label('Motion effects')
                ->default(fn (): bool => (bool) $this->preference('effects'))
                ->disabled(fn (): bool => !$this->overridesAllowed())
                ->dehydrated(false)
                ->live()
                ->afterStateUpdated(fn (bool $state) => $this->savePreference('effects', $state)),
            Toggle::make('voidwave_cursor')
                ->label('Cursor stardust')
                ->default(fn (): bool => (bool) $this->preference('cursor'))
                ->disabled(fn (): bool => !$this->overridesAllowed())
                ->dehydrated(false)
                ->live()
                ->afterStateUpdated(fn (bool $state) => $this->savePreference('cursor', $state)),
            Toggle::make('voidwave_floating')
                ->label('Floating accents')
                ->default(fn (): bool => (bool) $this->preference('floating'))
                ->disabled(fn (): bool => !$this->overridesAllowed())
                ->dehydrated(false)
                ->live()
                ->afterStateUpdated(fn (bool $state) => $this->savePreference('floating', $state)),
            Toggle::make('voidwave_compact')
                ->label('Compact density')
                ->default(fn (): bool => (bool) $this->preference('compact'))
                ->disabled(fn (): bool => !$this->overridesAllowed())
                ->dehydrated(false)
                ->live()
                ->afterStateUpdated(fn (bool $state) => $this->savePreference('compact', $state)),
            Toggle::make('voidwave_contrast')
                ->label('High contrast')
                ->default(fn (): bool => (bool) $this->preference('contrast'))
                ->disabled(fn (): bool => !$this->overridesAllowed())
                ->dehydrated(false)
                ->live()
                ->afterStateUpdated(fn (bool $state) => $this->savePreference('contrast', $state)),
            Toggle::make('voidwave_oled')
                ->label('OLED surfaces')
                ->default(fn (): bool => (bool) $this->preference('oled'))
                ->disabled(fn (): bool => !$this->overridesAllowed())
                ->dehydrated(false)
                ->live()
                ->afterStateUpdated(fn (bool $state) => $this->savePreference('oled', $state)),
            Select::make('voidwave_palette')
                ->label('Accent palette')
                ->options(['voidwave' => 'Voidwave', 'aurora' => 'Aurora', 'ember' => 'Ember', 'nebula' => 'Nebula'])
                ->selectablePlaceholder(false)
                ->required()
                ->default(fn (): string => (string) $this->preference('palette'))
                ->disabled(fn (): bool => !$this->overridesAllowed())
                ->dehydrated(false)
                ->live()
                ->afterStateUpdated(fn (string $state) => $this->savePreference('palette', $state)),
            Select::make('voidwave_ambience')
                ->label('Ambient intensity')
                ->options(['calm' => 'Calm', 'balanced' => 'Balanced', 'vivid' => 'Vivid'])
                ->selectablePlaceholder(false)
                ->required()
                ->default(fn (): string => (string) $this->preference('ambience'))
                ->disabled(fn (): bool => !$this->overridesAllowed())
                ->dehydrated(false)
                ->live()
                ->afterStateUpdated(fn (string $state) => $this->savePreference('ambience', $state)),
            Select::make('voidwave_surface')
                ->label('Surface style')
                ->options(['glass' => 'Glass', 'solid' => 'Solid', 'crystal' => 'Crystal'])
                ->selectablePlaceholder(false)
                ->required()
                ->default(fn (): string => (string) $this->preference('surface'))
                ->disabled(fn (): bool => !$this->overridesAllowed())
                ->dehydrated(false)
                ->live()
                ->afterStateUpdated(fn (string $state) => $this->savePreference('surface', $state)),
            Select::make('voidwave_sky')
                ->label('Sky density')
                ->options(['sparse' => 'Sparse', 'normal' => 'Normal', 'galaxy' => 'Galaxy'])
                ->selectablePlaceholder(false)
                ->required()
                ->default(fn (): string => (string) $this->preference('sky'))
                ->disabled(fn (): bool => !$this->overridesAllowed())
                ->dehydrated(false)
                ->live()
                ->afterStateUpdated(fn (string $state) => $this->savePreference('sky', $state)),
            Select::make('voidwave_radius')
                ->label('Corner style')
                ->options(['sharp' => 'Sharp', 'soft' => 'Soft', 'round' => 'Round'])
                ->selectablePlaceholder(false)
                ->required()
                ->default(fn (): string => (string) $this->preference('radius'))
                ->disabled(fn (): bool => !$this->overridesAllowed())
                ->dehydrated(false)
                ->live()
                ->afterStateUpdated(fn (string $state) => $this->savePreference('radius', $state)),
            Select::make('voidwave_scene')
                ->label('Celestial scene')
                ->options(['none' => 'None', 'eclipse' => 'Void Eclipse', 'rings' => 'Ringed World'])
                ->selectablePlaceholder(false)
                ->required()
                ->default(fn (): string => (string) $this->preference('scene'))
                ->disabled(fn (): bool => !$this->overridesAllowed())
                ->dehydrated(false)
                ->live()
                ->afterStateUpdated(fn (string $state) => $this->savePreference('scene', $state)),
            Select::make('voidwave_speed')
                ->label('Animation speed')
                ->options(['slow' => 'Slow', 'normal' => 'Normal', 'fast' => 'Fast'])
                ->selectablePlaceholder(false)
                ->required()
                ->default(fn (): string => (string) $this->preference('speed'))
                ->disabled(fn (): bool => !$this->overridesAllowed())
                ->dehydrated(false)
                ->live()
                ->afterStateUpdated(fn (string $state) => $this->savePreference('speed', $state)),
        ];
    }

    private function overridesAllowed(): bool
    {
        return (bool) config('voidwave-theme.allow_user_overrides', true);
    }

    private function preference(string $key): bool|string
    {
        $defaults = config('voidwave-theme.defaults', []);
        $user = user();
        $customization = $user?->customization ?? [];
        $stored = is_array($customization['voidwave'] ?? null) ? $customization['voidwave'] : [];

        return $stored[$key] ?? $defaults[$key];
    }

    private function savePreference(string $key, bool|string $value): void
    {
        if (!$this->overridesAllowed() || !user()) {
            return;
        }

        $user = user();
        $customization = $user->customization ?? [];
        $defaults = config('voidwave-theme.defaults', []);
        $stored = is_array($customization['voidwave'] ?? null) ? $customization['voidwave'] : [];
        $customization['voidwave'] = array_replace($defaults, $stored, [$key => $value]);
        $user->customization = $customization;
        $user->save();
    }
}
