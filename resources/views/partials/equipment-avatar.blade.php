{{--
    PARTIAL: partials/equipment-avatar.blade.php
    Affiche l'icône d'un équipement selon son type.

    Variables :
      - $type (string) : 'PC', 'Serveur', ou 'Switch'
--}}
@php
    $avatarMap = [
        'PC'      => ['class' => 'eq-avatar--pc',      'icon' => 'fa-laptop'],
        'Serveur' => ['class' => 'eq-avatar--serveur',  'icon' => 'fa-server'],
        'Switch'  => ['class' => 'eq-avatar--switch',   'icon' => 'fa-network-wired'],
    ];
    $avatar = $avatarMap[$type] ?? ['class' => 'eq-avatar--switch', 'icon' => 'fa-question'];
@endphp
<div class="eq-avatar {{ $avatar['class'] }}" aria-hidden="true">
    <i class="fas {{ $avatar['icon'] }}"></i>
</div>
