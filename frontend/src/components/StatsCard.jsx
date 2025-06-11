function StatsCard({ title, value }) {
  return (
    <div className="col-md-4 mb-3">
      <div className="bg-light p-3 rounded shadow-sm text-center">
        <h5>{title}</h5>
        <h2>{value}</h2>
      </div>
    </div>
  );
}

export default StatsCard;
