import React from 'react';
import ProgressChart from './ProgressChart';
import MostViewedLessons from './MostViewedLessons';
import UserActivityStats from './UserActivityStats';

function AnalyticsDashboard() {
  return (
    <div style={{ padding: '20px' }}>
      <h2 style={{ marginBottom: '20px' }}>Analytics Dashboard</h2>
      <ProgressChart />
      <UserActivityStats />
      <MostViewedLessons />
    </div>
  );
}

export default AnalyticsDashboard;
