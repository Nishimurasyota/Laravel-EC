<x-tests.app>
    <x-slot name="header">Header1</x-slot>
    component-test1

    <x-tests.card title="タイトル" content="本文" :message="$message" />
    <x-tests.card title="TITLE" />
    <x-tests.card title="CSS変更" />

    <x-tests.test-class-base classBaseMessage="メッセージです" />

</x-tests.app>
