import { useEffect, useState } from 'react'
import api from '../api/axios'

function MyTransactions() {
    const [transactions, setTransactions] = useState([])
    const [loading, setLoading] = useState(true)
    const [error, setError] = useState('')

    useEffect(() => {
        setLoading(true)
        api.get('/my-transactions')
            .then(res => {
                setTransactions(res.data)
                setLoading(false)
            })
            .catch(err => {
                console.error(err)
                setError('Error fetching your transactions')
                setLoading(false)
            })
    }, [])

    const formatPrice = (value) => {
        return new Intl.NumberFormat('en-EN', { style: 'currency', currency: 'EUR' }).format(value)
    }

    if (loading) return <p>Loading your purchases...</p>
    if (error) return <p className="error">{error}</p>

    return (
        <div className="page-container">
            <h2>My Purchases</h2>

            {transactions.length === 0 && <p>You have not made any purchases yet.</p>}

            {transactions.map(tx => (
                <div key={tx.id} className="transaction-card">
                    <p><strong>Date:</strong> {new Date(tx.created_at).toLocaleDateString()}</p>
                    <p><strong>Total:</strong> {formatPrice(tx.total_price)}</p>

                    <ul>
                        {tx.product_values.map(pv => (
                            <li key={pv.id}>
                                {pv.product.name} ({pv.condition}) – {formatPrice(pv.price)}
                            </li>
                        ))}
                    </ul>
                </div>
            ))}
        </div>
    )
}

export default MyTransactions