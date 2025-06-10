import React from 'react';
import {
  LineChart,
  Line,
  XAxis,
  YAxis,
  CartesianGrid,
  Tooltip,
  Legend,
  ResponsiveContainer
} from 'recharts';

const progressData = [
  { week: 'Week 1', completedLessons: 2 },
  { week: 'Week 2', completedLessons: 5 },
  { week: 'Week 3', completedLessons: 7 },
  { week: 'Week 4', completedLessons: 9 }
];

function ProgressChart() {
  return (
    <div style={{
      width: '100%',
      maxWidth: '800px',
      height: '300px',
      margin: '0 auto',
      marginTop: '20px',
      backgroundColor: '#e6f0ff',
      borderRadius: '10px',
      padding: '15px',
      boxShadow: '0 1px 3px rgba(0,0,0,0.1)'
    }}>
      <h3 style={{ color: '#3a8ee6', marginBottom: '10px' }}>Student Progress</h3>
      <ResponsiveContainer width="100%" height="100%">
        <LineChart data={progressData}>
          <CartesianGrid strokeDasharray="3 3" />
          <XAxis dataKey="week" />
          <YAxis />
          <Tooltip />
          <Legend />
          <Line type="monotone" dataKey="completedLessons" stroke="#3a8ee6" />
        </LineChart>
      </ResponsiveContainer>
    </div>
  );
}

export default ProgressChart;
