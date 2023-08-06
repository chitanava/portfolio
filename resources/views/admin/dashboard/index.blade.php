<x-admin.layout.app>
  <x-slot name="title">Dashboard</x-slot>
  
  <x-admin.page-header title="Dashboard" />
  <div>
    <livewire:admin.image-table />
  </div>
  <div class="space-y-10">
    <livewire:admin.retrieve-analytics-data wire:key="id-1" title="Visitors and page views" method="fetchVisitorsAndPageViews"/>
    <livewire:admin.retrieve-analytics-data wire:key="id-2" title="Visitors and page views by date" method="fetchVisitorsAndPageViewsByDate" :forHumans="['date']"/>
    <livewire:admin.retrieve-analytics-data wire:key="id-3" title="Most visited pages" method="fetchMostVisitedPages"/>
    <livewire:admin.retrieve-analytics-data wire:key="id-4" title="Top browsers" method="fetchTopBrowsers"/>
  </div>

</x-admin.layout.app>