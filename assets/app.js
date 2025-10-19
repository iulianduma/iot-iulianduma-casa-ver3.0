import React from 'react';
import { createRoot } from 'react-dom/client';
import SensorDashboard from './react/components/SensorDashboard';

const el = document.getElementById('sensor-dashboard');
if (el) {
  const root = createRoot(el);
  root.render(<SensorDashboard />);
}
