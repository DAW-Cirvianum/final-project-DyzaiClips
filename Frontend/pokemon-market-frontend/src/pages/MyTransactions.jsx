import { useEffect, useState } from 'react'
import api from '../api/axios'

function MyTransactions() {
    const [transactions, setTransactions] = useState([])

    useEffect(() => {
        api.get('/my-transactions')
            .then(res => setTransactions(res.data))
    }, [])

    return (
        <div className="page-container">
            <h2>My Purchases</h2>

            {transactions.map(tx => (
                <div key={tx.id} className="transaction-card">
                    <p><strong>Date:</strong> {new Date(tx.created_at).toLocaleDateString()}</p>
                    <p><strong>Total:</strong> €{tx.total_price}</p>

                    <ul>
                        {tx.product_values.map(pv => (
                            <li key={pv.id}>
                                {pv.product.name} ({pv.condition}) – €{pv.price}
                            </li>
                        ))}
                    </ul>
                </div>
            ))}
        </div>
    )
}

export default MyTransactions
