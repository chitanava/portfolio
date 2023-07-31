<x-admin.layout.app>
  <x-slot name="title">Dashboard</x-slot>
  
  <x-admin.page-header title="Dashboard" />

  <div class="space-y-10">
    <livewire:admin.retrieve-analytics-data title="Visitors and page views" method="fetchVisitorsAndPageViews"/>
    <livewire:admin.retrieve-analytics-data title="Visitors and page views by date" method="fetchVisitorsAndPageViewsByDate" :forHumans="['date']"/>
    <livewire:admin.retrieve-analytics-data title="Most visited pages" method="fetchMostVisitedPages"/>
    <livewire:admin.retrieve-analytics-data title="Top browsers" method="fetchTopBrowsers"/>
  </div>
</x-admin.layout.app>