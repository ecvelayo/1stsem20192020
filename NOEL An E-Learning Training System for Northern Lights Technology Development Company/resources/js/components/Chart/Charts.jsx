import React from 'react';
import { Bar, HorizontalBar } from 'react-chartjs-2';
import Axios from 'axios';
import TrendingUpRoundedIcon from '@material-ui/icons/TrendingUpRounded';

export default class Charts extends React.Component {
    state = {
        trainingSummary: {},
        averageScoreData: {},
        failedUsers: {}
    };
    componentDidMount = () => {
        const fetchData = async () => {
            let training_titles = [];
            let average_scores = [];
            let summary = [];
            // let failed = [];
            let passAndFail = [];

            const result = await Axios.get('/api/get/graph');
            const getSummary = (titles, summary) => {
                let data = [];
                let numEnrolled = {},
                    unfinished = {},
                    finished = {};
                let numEnrolledArr = [],
                    unfinishedArr = [],
                    finishedArr = [];

                // Counts the number of enrolled users
                titles.map(title => {
                    let enrolledCounter = 0;
                    let finishedCounter = 0;
                    let unfinishedCounter = 0;
                    summary.enrolled.filter(item => {
                        item.title === title ? enrolledCounter++ : null;
                    });
                    summary.finished.filter(item => {
                        item.title === title ? finishedCounter++ : null;
                    });
                    summary.unfinished.filter(item => {
                        item.title === title ? unfinishedCounter++ : null;
                    });
                    numEnrolledArr.push(enrolledCounter);
                    finishedArr.push(finishedCounter);
                    unfinishedArr.push(unfinishedCounter);
                });
                numEnrolled = {
                    label: '# of users enrolled',
                    backgroundColor: 'rgba(255, 206, 86, 0.6)',
                    data: numEnrolledArr
                };
                finished = {
                    label: '# of users finished',
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    data: finishedArr
                };
                unfinished = {
                    label: '# of users unfinished',
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    data: unfinishedArr
                };
                data.push(numEnrolled, finished, unfinished);
                return data;
            };
            const getAverage = tests => {
                let data = [];
                let avgArr = [],
                    userArr = [];
                let avg = {},
                    user = {},
                    highest = {};
                tests.total_scores.map(training => {
                    let scores = 0;
                    let average = 0;
                    let counter = 0;
                    tests.average.filter(item => {
                        if (item.title === training.title) {
                            scores += item.score / item.total_score;
                            counter++;
                        }
                    });
                    average = (scores / counter) * 100;
                    avgArr.push(average.toFixed(2));
                    // userArr.push(counter);
                });
                avg = {
                    label: 'Average score (%)',
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    data: avgArr
                };
                highest = {
                    label: 'Highest score (%)',
                    backgroundColor: 'rgba(56, 142, 60, 0.6)',
                    data: tests.highest
                }
                // user = {
                //     label: '# of users',
                //     backgroundColor: 'rgba(153, 102, 255, 0.6)',
                //     data: userArr
                // };
                data.push(avg, highest);
                return data;
            };
            const getPassedAndFailed = (titles, results) => {
                let data = [];
                let failedArr = [],
                    passedArr = [];
                let passed = {},
                    failed = {};
                titles.map(title => {
                    let counter = 0;
                    results.failed.filter(item => {
                        item.title === title ? counter++ : null;
                    });
                    failedArr.push(counter);
                });
                results.passed.map(item => {
                    passedArr.push(item.count);
                });
                failed = {
                    label: 'Number of retakes',
                    backgroundColor: 'rgba(244, 67, 54, .6)',
                    data: failedArr
                };
                passed = {
                    label: 'Number of passed users',
                    backgroundColor: 'rgba(255, 159, 64, 0.6)',
                    data: passedArr
                };
                data.push(passed, failed);
                return data;
            };

            result.data.titles.map(title => {
                // extracts the training titles
                // puts them to labels
                training_titles.push(title.title);
            });

            summary = getSummary(training_titles, result.data.summary);
            average_scores = getAverage(result.data.user_test);
            passAndFail = getPassedAndFailed(training_titles, result.data);

            this.setState({
                trainingSummary: {
                    labels: training_titles,
                    datasets: summary
                },
                // usersPerTrainingData: {
                //     labels: training_titles,
                //     datasets: [
                //         {
                //             label: '# of users enrolled',
                //             data: summary,
                //             backgroundColor: 'rgba(255, 206, 86, 0.2)',
                //             borderColor: 'rgba(255, 206, 86, 1)',
                //             borderWidth: 1
                //         }
                //     ]
                // },
                averageScoreData: {
                    labels: training_titles,
                    datasets: average_scores
                },
                // averageScoreData: {
                //     labels: training_titles,
                //     datasets: [
                //         {
                //             label: 'Average score of users per training',
                //             data: average_scores,
                //             backgroundColor: 'rgba(54, 162, 235, 0.5)',
                //             // borderColor: 'rgba(54, 162, 235, 1)',
                //             borderWidth: 1
                //         }
                //     ]
                // },

                // failedUsers: {
                //     labels: training_titles,
                //     datasets: [
                //         {
                //             label: '# of failed users',
                //             data: failed,
                //             backgroundColor: 'rgba(255, 159, 64, 0.6)',
                //             // borderColor: 'rgba(255, 99, 132, 1)',
                //             borderWidth: 1
                //         }
                //     ]
                // }

                failedUsers: {
                    labels: training_titles,
                    datasets: passAndFail
                }
            });
        };
        fetchData();
    };
    render() {
        return (
            <div className='my-5'>
                <div className='h4 mb-3'>
                    <TrendingUpRoundedIcon className='mr-2' /> Statistics
                </div>
                <hr />
                <div className='row my-4'>
                    <div className='col-md-6'>
                        <h5 className='text-center'>
                            Average score per training
                        </h5>
                        <HorizontalBar
                            data={this.state.averageScoreData}
                            width={100}
                            height={50}
                            options={{
                                maintainAspectRatio: true,
                                scales: {
                                    xAxes: [
                                        {
                                            ticks: {
                                                beginAtZero: true,
                                                suggestedMax: 100
                                            }
                                        }
                                    ]
                                }
                            }}
                        />
                    </div>
                    <div className='col-md-6'>
                        <h5 className='text-center'>
                            Overall employee performance
                        </h5>
                        <HorizontalBar
                            data={this.state.failedUsers}
                            width={100}
                            height={50}
                            options={{
                                maintainAspectRatio: true,
                                scales: {
                                    xAxes: [
                                        {
                                            ticks: {
                                                beginAtZero: true,
                                                stepSize: 1
                                            }
                                        }
                                    ]
                                }
                            }}
                        />
                    </div>
                </div>
                <div className='row'>
                    <div className='col-md'>
                        <div style={{ height: '400px' }}>
                            <h5 className='text-center'>
                                Summary of users per training
                            </h5>
                            <HorizontalBar
                                // data={data}
                                data={this.state.trainingSummary}
                                width={100}
                                height={40}
                                options={{
                                    maintainAspectRatio: true,
                                    scales: {
                                        yAxes: [
                                            {
                                                ticks: {
                                                    beginAtZero: true
                                                }
                                            }
                                        ],
                                        xAxes: [
                                            {
                                                ticks: {
                                                    stepSize: 1
                                                }
                                            }
                                        ]
                                    }
                                }}
                            />
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

// backgroundColor: [
//     'rgba(255, 99, 132, 0.2)'
//     'rgba(54, 162, 235, 0.2)',
//     'rgba(255, 206, 86, 0.2)',
//     'rgba(75, 192, 192, 0.2)',
//     'rgba(153, 102, 255, 0.2)',
//     'rgba(255, 159, 64, 0.2)'
// ],
// borderColor: [
//     'rgba(255, 99, 132, 1)'
//     'rgba(54, 162, 235, 1)',
//     'rgba(255, 206, 86, 1)',
//     'rgba(75, 192, 192, 1)',
//     'rgba(153, 102, 255, 1)',
//     'rgba(255, 159, 64, 1)'
// ],
